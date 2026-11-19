<?php

namespace Database\Factories;

use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

class DishFactory extends Factory
{
    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'name' => fake()->randomElement([
                'Sinigang na Hipon',
                'Pritong Isda',
                'Pancit Canton',
                'Kare-Kare',
                'Lechon Kawali',
                'Ginataang Gulay',
                'Chicken Inasal',
                'Halo-Halo',
                'Sizzling Sisig',
            ]),
            'price' => fake()->randomFloat(2, 40, 250),
            'is_bestseller' => false,
        ];
    }
}