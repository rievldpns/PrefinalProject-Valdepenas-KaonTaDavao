<?php

namespace Database\Factories;

use App\Models\Eatery;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermitFactory extends Factory
{
    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'permit_no' => 'DVO-' . fake()->numberBetween(2024, 2026) . '-' . fake()->unique()->numerify('1####'),
            'expires_on' => fake()->dateTimeBetween('-1 year', '+1 year'),
        ];
    }
}