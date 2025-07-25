<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseEnrollment>
 */
class CourseEnrollmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_id' => \App\Models\SemesterEnrollment::factory(),
            'course_id' => \App\Models\Course::factory(),
            'grade' => $this->faker->randomFloat(1, 0, 20),
        ];
    }
}
