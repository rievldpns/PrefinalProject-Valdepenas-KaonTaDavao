<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Sarah Valdepeñas',
            'email' => 'valdepenas@kaonta.test',
            'password' => Hash::make('kaonta2026'),
        ]);

        User::create([
            'name' => 'Tita Valdepeñas',
            'email' => 'tita.valdepenas@kaonta.test',
            'password' => Hash::make('kaonta2026'),
        ]);

        User::factory(10)->create();
    }
}