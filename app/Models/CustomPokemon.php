<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomPokemon extends Model
{
    use HasFactory;

    protected $table = 'custom_pokemons';

    protected $fillable = [
        'name',
        'attributes',
    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    protected $appends = [
        'is_custom',
    ];

    protected function isCustom(): Attribute
    {
        return Attribute::make(
            get: fn () => true,
        );
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
        );
    }
}
