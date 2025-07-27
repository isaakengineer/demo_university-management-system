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
            ['name' => 'student', 'fa_name' => 'دانشجو', 'description' => 'نقش دانشجو در سامانه', 'permissions' => null],
            ['name' => 'professor', 'fa_name' => 'استاد', 'description' => 'نقش استاد برای تدریس و پژوهش', 'permissions' => null],
            ['name' => 'department_head', 'fa_name' => 'رئیس گروه', 'description' => 'مدیر گروه آموزشی در یک دپارتمان', 'permissions' => null],
            ['name' => 'vice_educational', 'fa_name' => 'معاون آموزشی', 'description' => 'مسئول امور آموزشی در سطح دانشکده یا دانشگاه', 'permissions' => null],
            ['name' => 'vice_student_affairs', 'fa_name' => 'معاون دانشجویی', 'description' => 'مسئول امور مربوط به خدمات و رفاه دانشجویان', 'permissions' => null],
            ['name' => 'vice_research', 'fa_name' => 'معاون پژوهشی', 'description' => 'مسئول امور پژوهش، طرح‌های تحقیقاتی و مقالات علمی', 'permissions' => null],
            ['name' => 'dean', 'fa_name' => 'رئیس دانشکده', 'description' => 'مدیر ارشد یک دانشکده در دانشگاه', 'permissions' => null],
            ['name' => 'administrator', 'fa_name' => 'مدیر سیستم', 'description' => 'مدیر سیستم برای مدیریت فنی و دسترسی‌ها', 'permissions' => null],
        ];

        foreach ($roles as $role) {
            \App\Models\Role::create($role);
        }
    }
}
