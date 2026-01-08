<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomPokemonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $attributes = $this->attributes ?? [];

        return array_merge([
            'id' => $this->id,
            'name' => $this->name,
            'is_custom' => true, 
            'source' => 'local_db',
        ], $attributes);
    }
}
