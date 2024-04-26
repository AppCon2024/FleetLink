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

        // Define the brand and corresponding models
        $brandModelMapping = [
            'TOYOTA' => 'HILUX',
            'HONDA' => 'CIVIC',
        ];

        $brand = $this->faker->randomElement(['TOYOTA', 'HONDA']);
        $model = $brandModelMapping[$brand]; // Get the corresponding model based on the brand

        $vehicle = $this->faker->vehicleArray();

        return [
            'mv' => $this->faker->vehicleRegistration('[0-9]{4}-[0-9]{11}'),
            'cr' => $this->faker->vehicleRegistration('[0-9]{8}-[0-9]{1}'),
            'eng' => $this->faker->vehicleRegistration('[A-Z]{5}-[0-9]{7}'),
            'cha' => $this->faker->vehicleRegistration('[A-Z]{6}[0-9]{11}'),
            'plate' => $this->faker->vehicleRegistration('[A-Z]{3}[0-9]{3}'),
            'brand' => $brand,
            'model' => $model,
            'vin' => strtoupper($this->faker->vin),
            'status' => $this->faker->randomElement([0, 1]),
            'station' => $this->faker->randomElement(['Station 1', 'Station 2', 'Station 3', 'Station 4', 'Station 5', 'Station 6', 'Station 7', 'Station 8', 'Station 9', 'Station 10', 'Station 11', 'Station 12']),
            'type' => $this->faker->randomElement(['Car', 'Motor']),
            'qrcode' => '/qrcodes/CAL001.svg'
        ];
    }
}
