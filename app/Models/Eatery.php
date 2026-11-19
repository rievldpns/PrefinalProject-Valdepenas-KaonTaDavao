<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eatery extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'name',
        'slug',
        'address',
        'price_range',
        'specialty',
        'is_open',
    ];

    protected function casts(): array
    {
        return [
            'is_open' => 'boolean',
        ];
    }

    // makes {eatery} in the URL use the slug instead of the id
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}