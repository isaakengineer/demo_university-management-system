<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
     {
         //
         $departments = \App\Models\Department::whereIn('name', ['Computer Science', 'Engineering', 'Mathematics'])->get();
         $departmentCourses = [
             'Computer Science' => [
                 ['name' => 'Introduction to Programming', 'fa_name' => 'مقدمه ای بر برنامه نویسی', 'fa_description' => 'Basic programming concepts', 'credits' => 3],
                 ['name' => 'Data Structures', 'fa_name' => 'ساختمان داده', 'fa_description' => 'Fundamental data structures', 'credits' => 4],
                 ['name' => 'Algorithms', 'fa_name' => 'الگوریتم ها', 'fa_description' => 'Algorithm design and analysis', 'credits' => 4],
                 ['name' => 'Database Systems', 'fa_name' => 'سیستم های پایگاه داده', 'fa_description' => 'Database design and management', 'credits' => 3],
                 ['name' => 'Web Development', 'fa_name' => 'توسعه وب', 'fa_description' => 'Frontend and backend development', 'credits' => 3],
             ],
             'Engineering' => [
                 ['name' => 'Mechanics', 'fa_name' => 'مکانیک', 'fa_description' => 'Study of forces and motion', 'credits' => 4],
                 ['name' => 'Thermodynamics', 'fa_name' => 'ترمودینامیک', 'fa_description' => 'Principles of heat and energy', 'credits' => 4],
                 ['name' => 'Circuit Analysis', 'fa_name' => 'تحلیل مدار', 'fa_description' => 'Basics of electrical circuits', 'credits' => 3],
                 ['name' => 'Materials Science', 'fa_name' => 'علم مواد', 'fa_description' => 'Properties of materials', 'credits' => 3],
                 ['name' => 'Control Systems', 'fa_name' => 'سیستم های کنترل', 'fa_description' => 'Design of control mechanisms', 'credits' => 4],
             ],
             'Mathematics' => [
                 ['name' => 'Calculus', 'fa_name' => 'حسابان', 'fa_description' => 'Study of continuous change', 'credits' => 4],
                 ['name' => 'Linear Algebra', 'fa_name' => 'جبر خطی', 'fa_description' => 'Vector spaces and linear mappings', 'credits' => 3],
                 ['name' => 'Probability', 'fa_name' => 'احتمال', 'fa_description' => 'Theory of probability', 'credits' => 3],
                 ['name' => 'Statistics', 'fa_name' => 'آمار', 'fa_description' => 'Data analysis techniques', 'credits' => 3],
                 ['name' => 'Differential Equations', 'fa_name' => 'معادلات دیفرانسیل', 'fa_description' => 'Equations involving derivatives', 'credits' => 4],
             ],
         ];

         foreach ($departments as $department) {
             foreach ($departmentCourses[$department->name] as $course) {
                 $course['department_id'] = $department->id;
                 $course['professor_id'] = \App\Models\User::
                 whereHas('employments', function($q) use ($department) {
                    $q->where('role_id', \App\Models\Role::where('name', 'professor')->first()->id)->where('department_id', $department->id);
                 })->inRandomOrder()->first()->id;
                 \App\Models\Course::create($course);
             }
         }
     }
}
