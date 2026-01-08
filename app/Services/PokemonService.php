<?php

namespace App\Services;

use App\Models\BannedPokemon;
use Illuminate\Support\Facades\Http;

class PokemonService
{
    public function getPokemonInfo(array $inputNames): array
    {
        $names = array_map('strtolower', $inputNames);

        $bannedNames = BannedPokemon::whereIn('name', $names)
            ->pluck('name')
            ->toArray();

        $allowedNames = array_diff($names, $bannedNames);
        $results = [];

        foreach ($allowedNames as $name) {
            $data = $this->fetchFromApi($name);
            
            if ($data) {
                $results[] = $data;
            } else {
                $results[] = [
                    'name' => $name,
                    'error' => 'Not found in PokeAPI'
                ];
            }
        }

        return $results;
    }

    private function fetchFromApi(string $name): ?array
    {
        $baseUrl = config('services.pokeapi.url');
        $response = Http::withoutVerifying()->get($baseUrl . $name);

        if ($response->successful()) {
            $data = $response->json();
            
            return [
                'name' => $data['name'],
                'id' => $data['id'],
                'height' => $data['height'],
                'weight' => $data['weight'],
                'types' => collect($data['types'])->pluck('type.name')->toArray(),
                'source' => 'pokeapi' 
            ];
        }

        return null;
    }
}