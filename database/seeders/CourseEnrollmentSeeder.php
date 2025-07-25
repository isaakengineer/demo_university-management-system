<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all students with their department
        $students = \App\Models\User::whereHas('employments', function($q) {
            $q->whereHas('role', function($q) {
                $q->where('name', 'student');
            });
        })->with(['employments' => function($query) {
            $query->with('department');
        }])->get();

        foreach ($students as $student) {
            // Get department courses
            $departmentId = $student->employments()->first()->department_id;
            $courses = \App\Models\Course::where('department_id', $departmentId)->get();

            // Get current semester enrollment (created by SemesterEnrollmentSeeder)
            $semesterEnrollment = \App\Models\SemesterEnrollment::where('student_id', $student->id)
                ->where('year', date('Y'))
                ->where('semester', 1) // First semester of current year
                ->first();

            $totalCredits = 0;
            
            // Enroll in 3-5 random courses from department
            if ($semesterEnrollment) {
                $coursesToEnroll = $courses->random(rand(3, min(5, $courses->count())));
                foreach ($coursesToEnroll as $course) {
                    $grade = rand(0, 200) / 10; // Random grade between 0.0 and 20.0
                    \App\Models\CourseEnrollment::create([
                        'enrollment_id' => $semesterEnrollment->id,
                        'course_id' => $course->id,
                        'grade' => $grade,
                    ]);
                    $totalCredits += $course->credits;
                }

                // Calculate average grade from all course enrollments
                $averageGrade = \App\Models\CourseEnrollment::where('enrollment_id', $semesterEnrollment->id)
                    ->avg('grade');

                // Update semester enrollment with total credits and average grade
                $semesterEnrollment->update([
                    'credits' => $totalCredits,
                    'grade' => $averageGrade,
                ]);
            }
        }
    }
}
