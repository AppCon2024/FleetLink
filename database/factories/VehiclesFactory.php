<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Fakecar;
use App\Models\Vehicles;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicles>
 */
class VehiclesFactory extends Factory
{
    // /**
    //  * Define the model's default state.
    //  *
    //  *
    //  * @return array<string, mixed>
    //  */

    protected $model = Vehicles::class;


    public function definition(): array
    {
        $this->faker->addProvider(new Fakecar($this->faker));
        $vehicle = $this->faker->vehicleArray();
        return [
            'name' => 'vehicle',
            'role' => 'vehicle',
            'plate' => $this->faker->vehicleRegistration,
            'brand' => 'Toyota',
            'model' => 'Hilux',
            'vin' => $this->faker->vin,
            'unique_identifier' => fake()->numerify('##########'),
            'status' => fake()->randomElement([0,1]),

        ];
    }
}
