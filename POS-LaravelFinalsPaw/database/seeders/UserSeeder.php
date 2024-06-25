<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   // Seeder for owner
        User::updateOrCreate([
            'email' => 'admin@mail.com'
        ], [
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'phone_number' => '1234567890',
            'gender' => 'male',
            'address' => 'Admin Address',
            'date_of_birth' => '1975-03-03',
            'role' => 'owner',
        ]);

        // Seeder for kasir
        User::updateOrCreate([
            'email' => 'kasir@mail.com'
        ], [
            'name' => 'Kasir',
            'email' => 'kasir@kasir.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'phone_number' => '1234567890',
            'gender' => 'male',
            'address' => 'Kasir Address',
            'date_of_birth' => '1980-01-01',
            'role' => 'kasir',
        ]);

        // Seeder for gudang
        User::updateOrCreate([
            'email' => 'gudang@mail.com'
        ], [
            'name' => 'gudang',
            'email' => 'gudang@gudang.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'phone_number' => '0987654321',
            'gender' => 'male',
            'address' => 'gudang Address',
            'date_of_birth' => '1990-02-02',
            'role' => 'gudang',
        ]);
    }
}
