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
            'photo' => '/storage/images/17017649261by1.png',
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
}
