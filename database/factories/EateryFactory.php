<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EateryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->randomElement(['Carinderia ni', 'Kainan ni', 'Lutong Bahay ni', 'Eatery ni'])
            . ' ' . fake()->unique()->lastName();

        return [
            'district_id' => District::inRandomOrder()->value('id'),
            'name' => $name,
            'slug' => Str::slug($name),
            'address' => fake()->streetName() . ', Davao City',
            'price_range' => fake()->randomElement(['budget', 'mid', 'splurge']),
            'specialty' => fake()->randomElement([
                'Tinolang Manok',
                'Kinilaw na Tanigue',
                'Sinigang na Baboy',
                'Adobong Manok',
                'Bulalo',
                'Inihaw na Liempo',
                'Durian Shake',
                'Pochero',
            ]),
            'is_open' => true,
        ];
    }

    // kapag closed yung eatery
    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_open' => false,
        ]);
    }
}