<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannedPokemonResource;
use Illuminate\Http\Request;
use App\Models\BannedPokemon;

class BannedPokemonController extends Controller
{
    public function index()
    {
        return BannedPokemon::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:banned_pokemon,name'
        ]);

        $banned = BannedPokemon::create($validated);

        return response()->json($banned, 201);
    }

    public function destroy(string $name)
    {
        $pokemon = BannedPokemon::where('name', strtolower($name))->first();

        if (!$pokemon) {
            return response()->json([
                'status' => 'error',
                'message' => "Pokemon '$name' not found in banned list."
            ], 404);
        }

        $pokemon->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Pokemon '$name' has been removed from banned list."
        ], 200);
    }
}
