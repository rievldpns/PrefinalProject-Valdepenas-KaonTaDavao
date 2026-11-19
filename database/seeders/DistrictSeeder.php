<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Poblacion', 'Talomo', 'Agdao', 'Buhangin', 'Toril', 'Tugbok'];

        foreach ($names as $name) {
            District::create(['name' => $name]);
        }
    }
}