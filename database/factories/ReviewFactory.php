<?php

namespace Database\Factories;

use App\Models\Eatery;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'eatery_id' => Eatery::factory(),
            'user_id' => User::inRandomOrder()->value('id'),
            'rating' => fake()->numberBetween(1, 5),
            'body' => fake()->randomElement([
                'Sobrang sarap ng tinola, mura pa!',
                'The area was clean and the service was good.',
                'The food was delicious and the staff was friendly.',
                'Medyo mahal para sakin pero masarap pa rin.',
                'Okay lang pero matagal dumating yung pagkain.',
                'Favorite namin yung kinilaw dito.',
                'The soup was so hot, perfect for the rainy weather!',
                'Was not that good but its okay na for the price.',
            ]),
        ];
    }
}