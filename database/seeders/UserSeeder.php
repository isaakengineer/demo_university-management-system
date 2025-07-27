<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'fa_name' => 'کاربر مدیر',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assign admin role
        $adminRole = Role::where('name', 'administrator')->first();
        $adminDept = Department::where('name', 'Administration')->first();
        $admin->employments()->create([
            'role_id' => $adminRole->id,
            'department_id' => $adminDept->id,
        ]);

        // Create dean
        $dean = User::create([
            'name' => 'Dean User',
            'fa_name' => 'کاربر معاون',
            'email' => 'dean@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assign dean role
        $deanRole = Role::where('name', 'dean')->first();
        $dean->employments()->create([
            'role_id' => $deanRole->id,
            'department_id' => $adminDept->id,
        ]);

        // Create vice educational
        $viceEducational = User::create([
            'name' => 'Vice Educational',
            'fa_name' => 'معاون آموزشی',
            'email' => 'vice.educational@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assign vice educational role
        $viceEducationalRole = Role::where('name', 'vice_educational')->first();
        $viceEducational->employments()->create([
            'role_id' => $viceEducationalRole->id,
            'department_id' => $adminDept->id,
        ]);

        // Create vice student affairs
        $viceStudentAffairs = User::create([
            'name' => 'Vice Student Affairs',
            'fa_name' => 'معاون دانشجویی',
            'email' => 'vice.student@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assign vice student affairs role
        $viceStudentAffairsRole = Role::where('name', 'vice_student_affairs')->first();
        $viceStudentAffairs->employments()->create([
            'role_id' => $viceStudentAffairsRole->id,
            'department_id' => $adminDept->id,
        ]);

        // Create vice research
        $viceResearch = User::create([
            'name' => 'Vice Research',
            'fa_name' => 'معاون پژوهشی',
            'email' => 'vice.research@example.com',
            'password' => Hash::make('password'),
        ]);

        // Assign vice research role
        $viceResearchRole = Role::where('name', 'vice_research')->first();
        $viceResearch->employments()->create([
            'role_id' => $viceResearchRole->id,
            'department_id' => $adminDept->id,
        ]);

        // Create department heads, professors and students
        $departments = Department::where('name', '!=', 'Administration')->get();
        $studentRole = Role::where('name', 'student')->first();
        $professorRole = Role::where('name', 'professor')->first();
        $headRole = Role::where('name', 'department_head')->first();

        foreach ($departments as $department) {
            // Department head
            $head = User::create([
                'name' => 'Head of ' . $department->name,
                'fa_name' => 'رئیس ' . $department->fa_name,
                'email' => 'head.' . strtolower($department->name) . '@example.com',
                'password' => Hash::make('password'),
            ]);

            $head->employments()->create([
                'role_id' => $headRole->id,
                'department_id' => $department->id,
            ]);

            // Professors (2-4 per department)
            $professorCount = rand(2, 4);
            for ($i = 1; $i <= $professorCount; $i++) {
                $professor = User::create([
                    'name' => 'Professor ' . $i . ' ' . $department->name,
                    'fa_name' => 'استاد ' . $i . ' ' . $department->fa_name,
                    'email' => 'professor' . $i . '.' . strtolower($department->name) . '@example.com',
                    'password' => Hash::make('password'),
                ]);

                $professor->employments()->create([
                    'role_id' => $professorRole->id,
                    'department_id' => $department->id,
                ]);
            }

            // Students (5-10 per department)
            $studentCount = rand(5, 10);
            for ($i = 1; $i <= $studentCount; $i++) {
                $student = User::create([
                    'name' => 'Student ' . $i . ' ' . $department->name,
                    'fa_name' => 'دانشجو ' . $i . ' ' . $department->fa_name,
                    'email' => 'student' . $i . '.' . strtolower($department->name) . '@example.com',
                    'password' => Hash::make('password'),
                ]);

                $student->employments()->create([
                    'role_id' => $studentRole->id,
                    'department_id' => $department->id,
                ]);
            }
        }
    }
}
