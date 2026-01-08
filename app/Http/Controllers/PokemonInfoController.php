<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PokemonService;
use App\Http\Requests\GetPokemonInfoRequest;
use Illuminate\Http\JsonResponse;

class PokemonInfoController extends Controller
{
    public function __construct(
        protected PokemonService $pokemonService
    ) {}

    public function __invoke(GetPokemonInfoRequest $request): JsonResponse
    {
        $names = $request->validated('names');

        $data = $this->pokemonService->getPokemonInfo($names);

        return response()->json([
            'data' => $data
        ]);
    }
}
