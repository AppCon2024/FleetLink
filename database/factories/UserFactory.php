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
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement([0,1]),
            'role' => fake()->randomElement(['supervisor', 'police']),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'name' => function (array $attributes) {
                return $attributes['first_name'] . ' ' . $attributes['last_name'];
            },
            'employee_id' => fake()->numerify('######'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'department' => fake()->randomElement(['Admin PNCO', 'Operation PNCO', 'Investigation PNCO', 'Finance PNCO', 'Logistics PNCO', 'Police Clearance PNCO', 'Admin PNCO', 'Intel PNCO']),
            'position' => fake()->randomElement(['Police Captain Deputy', 'Police Executive Master Sergeant', 'Station Support and Services Officer', 'Police Lieutenant', 'Police Chief Master Sergeant', 'Police Master Sergeant', 'Police Staff Sergeant', 'Police Corporal', 'Police Major', 'Patrolman', 'Patrolwoman']),
            'password' => static::$password ??= Hash::make('password'),
            'image' => 'img/karl.png',
            'remember_token' => Str::random(10),
            'station' => fake()->randomElement(['Station 1','Station 2','Station 3','Station 4','Station 5','Station 6','Station 7','Station 8','Station 9','Station 10','Station 11','Station 12']),
            'shift' => fake()->randomElement(['Morning','Night']),

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
}
