<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAccounts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Admin Karl
        User::create([
            'status' => 1,
            'image' => 'img/karl.png',
            'last_name' => ('Karl'),
            'first_name' => ('Admin'),
            'employee_id' => '325543',
            'name' => 'Admin Karl',
            'email' => 'adminkarl@f.l',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'admin',
            'department' => 'Admin PNCO',
            'position' => 'Patrolman',
            'station' => 'admin',
            'shift' => 'Morning'
        ]);

        //Admin Kurt
        // User::create([
        //     'status' => 1,
        //     'image' => 'img/kurt.jpg',
        //     'last_name' => ('Kurt'),
        //     'first_name' => ('Admin'),
        //     'employee_id' => '424634',
        //     'name' => 'Admin Kurt',
        //     'email' => 'adminkurt@f.l',
        //     'email_verified_at' => '2024-03-01 01:33:52',
        //     'password' => Hash::make('12345'),
        //     'role' => 'admin',
        //     'department' => 'Admin PNCO',
        //     'position' => 'Patrolman',
        //     'station' => 'admin',
        //     'shift' => 'Morning'
        // ]);

        //Supervisor Leah
        User::create([
            'status' => 1,
            'image' => 'img/leah.jpg',
            'last_name' => 'Leah',
            'first_name' => 'Supervisor',
            'employee_id' => '852386',
            'name' => 'Supervisor Leah',
            'email' => 'supervisorleah@f.l',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'supervisor',
            'department' => 'Intel PNCO',
            'position' => 'Police Captain Deputy',
            'station' => 'Station 1',
            'shift' => 'Morning'
        ]);

        //Supervisor Mae
        User::create([
            'status' => 1,
            'image' => 'img/mae.jpg',
            'last_name' => 'Mae',
            'first_name' => 'Supervisor',
            'employee_id' => '461264',
            'name' => 'Supervisor Mae',
            'email' => 'supervisormae@f.l',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'supervisor',
            'department' => 'Intel PNCO',
            'position' => 'Police Captain Deputy',
            'station' => 'Station 2',
            'shift' => 'Morning'
        ]);

        //Officer Karl
        User::create([
            'status' => 1,
            'image' => 'img/karl.png',
            'last_name' => 'Karl',
            'first_name' => 'Officer',
            'employee_id' => '543235',
            'name' => 'Officer Karl',
            'email' => 'officerkarl@f.l',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'police',
            'department' => 'Intel PNCO',
            'position' => 'Patrolman',
            'station' => 'Station 1',
            'shift' => 'Morning'
        ]);

        //Officer Kurt
        User::create([
            'status' => 1,
            'image' => 'img/kurt.jpg',
            'last_name' => 'Kurt',
            'first_name' => 'Officer',
            'employee_id' => '434564',
            'name' => 'Officer Kurt',
            'email' => 'officerkurt@f.l',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'police',
            'department' => 'Intel PNCO',
            'position' => 'Patrolman',
            'station' => 'Station 2',
            'shift' => 'Night'
        ]);

        //Officer Mae
        User::create([
            'status' => 1,
            'image' => 'img/mae.jpg',
            'last_name' => 'Mae',
            'first_name' => 'Officer',
            'employee_id' => '642433',
            'name' => 'Officer Mae',
            'email' => 'officermae@f.l',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'police',
            'department' => 'Intel PNCO',
            'position' => 'Patrolman',
            'station' => 'Station 1',
            'shift' => 'Morning'
        ]);

        //Officer Leah
        User::create([
            'status' => 1,
            'image' => 'img/leah.jpg',
            'last_name' => 'Leah',
            'first_name' => 'Officer',
            'employee_id' => '642433',
            'name' => 'Officer Leah',
            'email' => 'officerleah@f.l',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'police',
            'department' => 'Intel PNCO',
            'position' => 'Patrolman',
            'station' => 'Station 2',
            'shift' => 'Night'
        ]);
    }
}
