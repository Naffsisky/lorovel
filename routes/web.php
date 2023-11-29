<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;
use App\Http\Controllers\BMKGController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\NotesController;

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

Route::get('/notes', [NotesController::class, 'getIndexData'])->name('notes');

Route::get('/notes/{id}/edit', [NotesController::class, 'editNote'])->name('notes.edit');

Route::put('/notes/{id}', [NotesController::class, 'updateNote'])->name('notes.update');

Route::delete('/notes/{id}', [NotesController::class, 'deleteNote'])->name('notes.destroy');

Route::get('/notes/create', [NotesController::class, 'createNoteForm'])->name('notes.create');

Route::post('/notes', [NotesController::class, 'createNote'])->name('notes.store');
