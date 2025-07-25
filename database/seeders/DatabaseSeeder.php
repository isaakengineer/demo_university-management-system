<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use UniversityManagementSystem\ApprovalManagementSystem\Database\Seeders\DatabaseSeeder as ApprovalSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            DepartmentSeeder::class,
            UserSeeder::class,
            CourseSeeder::class,
            SemesterEnrollmentSeeder::class,
            CourseEnrollmentSeeder::class,
        ]);

        $this->call([
            ApprovalSeeder::class
        ]);
    }
}
