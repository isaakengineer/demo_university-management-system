<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'fa_name' => fn() => $this->faker->name(), // Same name but in Persian/Arabic script
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $role = \App\Models\Role::inRandomOrder()->first();
            \App\Models\Employment::create([
                'user_id' => $user->id,
                'role_id' => $role->id,
                'department_id' => $role->name === 'administrator' || $role->name === 'dean'
                    ? \App\Models\Department::where('name', 'Administration')->first()->id
                    : \App\Models\Department::where('name', '!=', 'Administration')->inRandomOrder()->first()->id,
            ]);
        });
    }
}
