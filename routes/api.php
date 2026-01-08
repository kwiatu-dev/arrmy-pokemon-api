<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BannedPokemonController;
use App\Http\Controllers\CustomPokemonController;
use App\Http\Controllers\PokemonInfoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resource('banned', BannedPokemonController::class)
    ->only(['index', 'store', 'destroy'])
    ->parameters([
        'banned' => 'name'
    ])
    ->names([
        'index' => 'banned.list',
        'store' => 'banned.add',
        'destroy' => 'banned.remove'
    ])
    ->middleware('secret_key');

Route::resource('custom', CustomPokemonController::class)
    ->only(['index', 'store', 'destroy', 'update'])
    ->parameters([
        'custom' => 'name'
    ])
    ->names([
        'index' => 'custom.list',
        'store' => 'custom.add',
        'destroy' => 'custom.remove',
        'update' => 'custom.update'
    ])
    ->middleware('secret_key');

Route::get('/info', PokemonInfoController::class);
