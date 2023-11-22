<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\BMKGController;
use App\Http\Controllers\MovieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// })->name('index');

Route::get('/', [APIController::class, 'getIndexData'])->name('index');

Route::get('/weather', [BMKGController::class, 'getIndexBMKG'])->name('weather');

Route::get('/movies', [MovieController::class, 'getMovieData'])->name('movies');

Route::get('/foods', [APIController::class, 'getFoods'])->name('foods');

Route::get('/notes', function () {
    return view('notes');
})->name('notes');