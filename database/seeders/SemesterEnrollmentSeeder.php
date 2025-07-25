<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemesterEnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all students
        $students = \App\Models\User::whereHas('employments', function($q) {
            $q->whereHas('role', function($q) {
                $q->where('name', 'student');
            });
        })->get();

        $currentYear = date('Y');
        
        foreach ($students as $student) {
            // Current year enrollments (2 semesters)
            for ($semester = 1; $semester <= 2; $semester++) {
                \App\Models\SemesterEnrollment::create([
                    'student_id' => $student->id,
                    'year' => $currentYear,
                    'semester' => $semester,
                    'credits' => 0, // Will be updated by CourseEnrollmentSeeder
                    'credits_max' => 24,
                    'grade' => null,
                ]);
            }

            // Previous year enrollments (2 semesters)
            for ($semester = 1; $semester <= 2; $semester++) {
                \App\Models\SemesterEnrollment::create([
                    'student_id' => $student->id,
                    'year' => $currentYear - 1,
                    'semester' => $semester,
                    'credits' => rand(15, 30), // Random credits for past semesters
                    'credits_max' => 24,
                    'grade' => rand(10, 20) / 10, // Random grade between 1.0 and 2.0
                ]);
            }
        }
    }
}
