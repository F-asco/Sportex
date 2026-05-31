<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Jan Kowalski',
            'email' => 'client@sportex.pl',
            'password' => Hash::make('haslo123'),
            'role' => 'client',
        ]);

        User::create([
            'name' => 'Maciej Nowak',
            'email' => 'employee@sportex.pl',
            'password' => Hash::make('haslo123'),
            'role' => 'employee',
        ]);

        User::create([
            'name' => 'Szef Administrator',
            'email' => 'admin@sportex.pl',
            'password' => Hash::make('haslo123'),
            'role' => 'admin',
        ]);
    }
}