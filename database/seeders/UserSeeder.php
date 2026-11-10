<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@minimarket.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Akun Kasir
        User::create([
            'name' => 'Kasir 1',
            'email' => 'kasir@minimarket.test',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]);
    }
}