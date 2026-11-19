<?php

namespace Database\Seeders;

use App\Models\Eatery;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $name = 'Carinderia ni Valdepeñas';
        $mine = Eatery::where('name', $name)->first();
        $tita = User::where('email', 'tita.valdepenas@kaonta.test')->first();

        $mine->reviews()->create([
            'user_id' => $tita->id,
            'rating' => 5,
            'body' => 'Lami kaayo! Balik-balikan ni Tita Valdepeñas.',
        ]);

        Review::factory()->count(2)->for($mine)->create();

        $others = Eatery::where('is_open', true)->where('name', '!=', $name)->get();

        foreach ($others as $eatery) {
            Review::factory()->count(rand(0, 6))->for($eatery)->create();
        }
    }
}