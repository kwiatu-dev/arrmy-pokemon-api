<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannedPokemon extends Model
{
    protected $table = 'banned_pokemon';

    protected $fillable = [
        'name',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower($value),
        );
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
