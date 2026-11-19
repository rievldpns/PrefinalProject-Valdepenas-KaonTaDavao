<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\District;
use App\Models\Eatery;
use App\Models\Feature;
use App\Models\Permit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EaterySeeder extends Seeder
{
    public function run(): void
    {
        $poblacion = District::where('name', 'Poblacion')->first();
        $name = 'Carinderia ni Valdepeñas';

        $mine = Eatery::create([
            'district_id' => $poblacion->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => 'San Pedro St., Poblacion, Davao City',
            'price_range' => 'budget',
            'specialty' => 'Tinolang Manok',
            'is_open' => true,
        ]);

        $featureIds = Feature::whereIn('name', ['Suki ni Valdepeñas', 'Budget Meal'])
            ->pluck('id')
            ->all();
        $mine->features()->sync($featureIds);

        $mine->permit()->create([
            'permit_no' => 'DVO-2026-0509',
            'expires_on' => '2027-05-09',
        ]);

        $mine->dishes()->createMany([
            ['name' => 'Tinolang Manok', 'price' => 85.00, 'is_bestseller' => true],
            ['name' => 'Kinilaw na Tuna', 'price' => 120.00, 'is_bestseller' => false],
            ['name' => 'Durian Shake', 'price' => 75.00, 'is_bestseller' => false],
        ]);

        $allFeatureIds = Feature::pluck('id');

        for ($i = 1; $i <= 14; $i++) {
            $eatery = $i <= 3
                ? Eatery::factory()->closed()->create()
                : Eatery::factory()->create();

            if ($i === 1) {
                Permit::factory()->for($eatery)->create(['expires_on' => now()->subMonths(2)]);
            } else {
                Permit::factory()->for($eatery)->create();
            }

            Dish::factory()->count(rand(2, 5))->for($eatery)->create();

            $eatery->features()->attach($allFeatureIds->random(rand(1, 3))->all());
        }
    }
}