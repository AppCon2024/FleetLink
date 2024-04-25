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
            'mv' => $this->faker->vehicleRegistration('[0-9]{4}-[0-9]{11}'),
            'cr' => $this->faker->vehicleRegistration('[0-9]{8}-[0-9]{1}'),
            'eng' => $this->faker->vehicleRegistration('[A-Z]{5}-[0-9]{7}'),
            'cha' => $this->faker->vehicleRegistration('[A-Z]{6}[0-9]{11}'),
            'plate' => $this->faker->vehicleRegistration,
            'brand' => $this->faker->vehicleBrand,
            'model' => $this->faker->vehicleModel,
            'vin' => $this->faker->vin,
            'status' => fake()->randomElement([0,1]),
            'station' => fake()->randomElement(['Station 1','Station 2','Station 3','Station 4','Station 5','Station 6','Station 7','Station 8','Station 9','Station 10','Station 11','Station 12']),
            'type' => fake()->randomElement(['Car','Motor']),
            'qrcode' => '/qrcodes/CAL001.svg'
        ];
    }
}
