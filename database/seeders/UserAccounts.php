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

        $admin = User::create([
            'status' => 1,
            'image' => 'storage/images/karl.jpg',
            'last_name' => ('Doctolero'),
            'first_name' => ('Karl Lewis'),
            'employee_id' => '12345',
            'name' => 'Karl Lewis Doctolero',
            'email' => 'karllewistdoctolero@gmail.com',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'admin',
            'department' => 'Software Developer/Admin',
            'position' => 'Patrolman'
        ]);

        $admin = User::create([
            'status' => 1,
            'image' => 'storage/images/karl.jpg',
            'last_name' => ('admin'),
            'first_name' => ('.'),
            'employee_id' => '12345',
            'name' => 'admin',
            'email' => 'admin@c.c',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'admin',
            'department' => 'Software Developer/Admin',
            'position' => 'Patrolman'
        ]);

        // seeding collector
        $collector = User::create([
            'status' => 1,
            'image' => 'storage/images/kurt.jpg',
            'last_name' => 'Nanalis',
            'first_name' => 'Kurt Axel',
            'employee_id' => '12345',
            'name' => 'Kurt Axel Nanalis',
            'email' => 'kurt@gmail.com',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'supervisor',
            'department' => 'Software Developer/Admin',
            'position' => 'Patrolman'

        ]);

        // seeding residents
        $police = User::create([
            'status' => 1,
            'image' => 'storage/images/leah.jpg',
            'last_name' => 'Oquindo',
            'first_name' => 'Ma. Leah',
            'employee_id' => '12345',
            'name' => 'Ma. Leah Oquindo',
            'email' => 'leah@gmail.com',
            'email_verified_at' => '2024-03-01 01:33:52',
            'password' => Hash::make('12345'),
            'role' => 'police',
            'department' => 'Software Developer/Admin',
            'position' => 'Patrolman'
        ]);



    }
}
