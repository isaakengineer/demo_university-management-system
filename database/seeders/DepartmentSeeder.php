<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name' => 'Administration', 'fa_name' => 'اداره', 'fa_description' => 'Default department for administrative staff'],
            ['name' => 'Computer Science', 'fa_name' => 'علوم کامپیوتر', 'fa_description' => 'Department of Computer Science'],
            ['name' => 'Engineering', 'fa_name' => 'مهندسی', 'fa_description' => 'Department of Engineering'],
            ['name' => 'Mathematics', 'fa_name' => 'ریاضیات', 'fa_description' => 'Department of Mathematics'],
        ];

        foreach ($departments as $department) {
            \App\Models\Department::create($department);
        }
    }
}
