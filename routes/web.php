<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/category', [FrontController::class,'index']);
Route::post('/category', [FrontController::class,'store'])->name('categories.store');
Route::get('/category/data', [FrontController::class,'show'])->name('categories.show');
Route::delete('/category/delete/{id}', [FrontController::class,'destroy'])->name('categories.destroy');
Route::put('/category/update/{id}', [FrontController::class,'update'])->name('categories.update');
Route::get('/film', [FilmController::class,'index']);
Route::get('/film/data', [FilmController::class,'show'])->name('films.show');
Route::post('/film', [FilmController::class,'store'])->name('films.store');
Route::delete('/film/delete/{id}', [FilmController::class,'destroy'])->name('film.destroy');
Route::POST('/film/update', [FilmController::class,'update'])->name('film.update');

Route::get('/auth/redirect', [AuthController::class,'redirect']);
Route::get('/auth/google/callback', [AuthController::class,'callback']);

require __DIR__.'/auth.php';
