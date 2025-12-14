<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;


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

// Home
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category:slug}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category:slug}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category:slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Movies
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
Route::get('/movies/{movie:slug}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/movies/{movie:slug}/edit', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('/movies/{movie:slug}', [MovieController::class, 'update'])->name('movies.update');
Route::delete('/movies/{movie:slug}', [MovieController::class, 'destroy'])->name('movies.destroy');

// Reviews (nested under movies)
Route::post('/movies/{movie:slug}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/movies/{movie:slug}/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/movies/{movie:slug}/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
Route::delete('/movies/{movie:slug}/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
