<?php

namespace Database\Seeders;

use App\Models\Vehicles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicles::create([
            'plate' => 'CAL001',
            'brand' => 'Toyota',
            'model' => 'Hillux',
            'vin' => 'dgs4tswr2q3edfsfd',
            'station' => 'Station 1',
            'type' => 'Car',
            'status' => '1',
            'qrcode' => '/qrcodes/qrcode_CAL001.svg',
        ]);

        Vehicles::create([
            'plate' => 'CAL002',
            'brand' => 'Honda',
            'model' => 'Civic',
            'vin' => 'gdfsgs45dfq3wedv',
            'station' => 'Station 1',
            'type' => 'Car',
            'status' => '1',
            'qrcode' => '/qrcodes/qrcode_CAL002.svg',
        ]);

        Vehicles::create([
            'plate' => 'CAL003',
            'brand' => 'Subaru ',
            'model' => 'Outback',
            'vin' => 'ergsrtgtgs3a345sd',
            'station' => 'Station 1',
            'type' => 'Car',
            'status' => '1',
            'qrcode' => '/qrcodes/qrcode_CAL003.svg',
        ]);

        Vehicles::create([
            'plate' => 'CAL004',
            'brand' => 'BMW ',
            'model' => 'Sedan',
            'vin' => 'fadgrgttaw3r4awefd',
            'station' => 'Station 1',
            'type' => 'Car',
            'status' => '1',
            'qrcode' => '/qrcodes/qrcode_CAL004.svg',
        ]);
    }
}
