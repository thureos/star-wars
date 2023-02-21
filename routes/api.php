<?php

use App\Http\Controllers\StarWarsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(StarWarsController::class)->group(function () {
    Route::get('/star-wars/people/luke/starships', 'lukesShips')->name('star-wars.luke.starships');
    Route::get('/star-wars/films/phantom/species/classification', 'speciesClassifficationForPhantom')->name('star-wars.movies.phantom.species.classification');
    Route::get('/star-wars/galaxy/population', 'galaxyPopulation')->name('star-wars.galaxy.population');
})->middleware('guest');
