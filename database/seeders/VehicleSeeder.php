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
            'mv' => '1234-12345678901',
            'cr' => '12345678-9',
            'eng' => 'A1B2C-1234567',
            'cha' => 'AB0CD1234E5678901',
            'brand' => 'Toyota',
            'model' => 'Hillux',
            'vin' => '1A2BCDE3F4567890',
            'station' => 'Station 1',
            'type' => 'Car',
            'status' => '1',
            'qrcode' => '/qrcodes/CAL001.svg',
        ]);

        Vehicles::create([
            'plate' => 'CAL002',
            'mv' => '1234-12345678902',
            'cr' => '12345678-2',
            'eng' => 'A1B2C-1234562',
            'cha' => 'AB0CD1234E5678902',
            'brand' => 'Honda',
            'model' => 'Civic',
            'vin' => '1A2BCDE3F4567892',
            'station' => 'Station 1',
            'type' => 'Car',
            'status' => '1',
            'qrcode' => '/qrcodes/CAL002.svg',
        ]);

        Vehicles::create([
            'plate' => 'CAL003',
            'mv' => '1234-12345678903',
            'cr' => '12345678-3',
            'eng' => 'A1B2C-1234563',
            'cha' => 'AB0CD1234E5678903',
            'brand' => 'Subaru ',
            'model' => 'Outback',
            'vin' => '1A2BCDE3F4567893',
            'station' => 'Station 1',
            'type' => 'Car',
            'status' => '1',
            'qrcode' => '/qrcodes/CAL003.svg',
        ]);

        Vehicles::create([
            'plate' => 'CAL004',
            'mv' => '1234-12345678904',
            'cr' => '12345678-4',
            'eng' => 'A1B2C-1234564',
            'cha' => 'AB0CD1234E5678904',
            'brand' => 'BMW ',
            'model' => 'Sedan',
            'vin' => '1A2BCDE3F4567894',
            'station' => 'Station 1',
            'type' => 'Car',
            'status' => '1',
            'qrcode' => '/qrcodes/CAL004.svg',
        ]);
    }
}
