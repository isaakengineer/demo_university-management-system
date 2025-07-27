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

            // Semester 1 enrollment with grades
            $semester1Enrollment = \App\Models\SemesterEnrollment::where('student_id', $student->id)
                ->where('year', date('Y'))
                ->where('semester', 1)
                ->first();

            $totalCredits1 = 0;

            if ($semester1Enrollment) {
                $coursesToEnroll1 = $courses->random(rand(3, min(5, $courses->count())));
                foreach ($coursesToEnroll1 as $course) {
                    $grade = rand(0, 200) / 10; // Random grade between 0.0 and 20.0
                    \App\Models\CourseEnrollment::create([
                        'enrollment_id' => $semester1Enrollment->id,
                        'course_id' => $course->id,
                        'grade' => $grade,
                    ]);
                    $totalCredits1 += $course->credits;
                }

                $averageGrade1 = \App\Models\CourseEnrollment::where('enrollment_id', $semester1Enrollment->id)
                    ->avg('grade');

                $semester1Enrollment->update([
                    'credits' => $totalCredits1,
                    'grade' => $averageGrade1,
                ]);
            }

            // Semester 2 enrollment without grades
            $semester2Enrollment = \App\Models\SemesterEnrollment::where('student_id', $student->id)
                ->where('year', date('Y'))
                ->where('semester', 2)
                ->first();

            $totalCredits2 = 0;

            if ($semester2Enrollment) {
                $coursesToEnroll2 = $courses->random(rand(3, min(5, $courses->count())));
                foreach ($coursesToEnroll2 as $course) {
                    \App\Models\CourseEnrollment::create([
                        'enrollment_id' => $semester2Enrollment->id,
                        'course_id' => $course->id,
                        'grade' => null,
                    ]);
                    $totalCredits2 += $course->credits;
                }

                $semester2Enrollment->update([
                    'credits' => $totalCredits2,
                    'grade' => null,
                ]);
            }
        }
    }
}
