<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'student', 'fa_name' => 'دانشجو', 'description' => 'Student role', 'permissions' => null],
            ['name' => 'professor', 'fa_name' => 'استاد', 'description' => 'Professor role', 'permissions' => null],
            ['name' => 'department_head', 'fa_name' => 'رئیس گروه', 'description' => 'Department head role', 'permissions' => null],
            ['name' => 'vice_educational_advisor', 'fa_name' => 'معاون آموزشی', 'description' => 'Vice educational advisor role', 'permissions' => null],
            ['name' => 'dean', 'fa_name' => 'مدیر آموزش', 'description' => 'Dean role', 'permissions' => null],
            ['name' => 'administrator', 'fa_name' => 'مدیر سیستم', 'description' => 'Administrator role', 'permissions' => null],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
    }
}
