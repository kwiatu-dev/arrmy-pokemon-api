<?php

namespace App\Http\Controllers;

use App\Models\CustomPokemon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CustomPokemonResource;
use App\Http\Requests\StoreCustomPokemonRequest;

class CustomPokemonController extends Controller
{
    public function index()
    {
        return CustomPokemonResource::collection(CustomPokemon::all());
    }

    public function store(StoreCustomPokemonRequest $request)
    {
        $data = $request->validated();
        $name = $data['name'];
        $attributes = $request->only(['height', 'weight', 'types']);

        $pokemon = CustomPokemon::create([
            'name' => $name, 
            'attributes' => $attributes
        ]);

        return response()->json(new CustomPokemonResource($pokemon), 201);
    }

    public function destroy(string $idOrName)
    {
        $pokemon = is_numeric($idOrName) 
            ? CustomPokemon::find($idOrName) 
            : CustomPokemon::where('name', strtolower($idOrName))->first();

        if (!$pokemon) {
            return response()->json([
                'status' => 'error',
                'message' => "Pokemon '$name' not found in custom list."
            ], 404);
        }

        $pokemon->delete();

        return response()->json([
            'status' => 'success',
            'message' => "Pokemon '$name' has been removed from custom list."
        ], 200);
    }

    public function update(Request $request, $id)
    {
        //
    }
}
