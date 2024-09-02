<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FrontController;

Route::get('/', function () {
    return view('welcome');
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