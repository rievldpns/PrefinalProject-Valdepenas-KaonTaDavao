<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Suki ni Valdepeñas',
            'Budget Meal',
            'Halal',
            'Open 24 Hours',
            'Aircon',
            'Free Wifi',
        ];

        foreach ($names as $name) {
            Feature::create(['name' => $name]);
        }
    }
}