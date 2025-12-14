<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

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
Route::get('/categories', function () {
    return 'Categories index (placeholder)';
})->name('categories.index');

Route::get('/categories/create', function () {
    return 'Categories create (placeholder)';
})->name('categories.create');

Route::post('/categories', function () {
    return 'Categories store (placeholder)';
})->name('categories.store');

Route::get('/categories/{category:slug}', function () {
    return 'Categories show (placeholder)';
})->name('categories.show');

Route::get('/categories/{category:slug}/edit', function () {
    return 'Categories edit (placeholder)';
})->name('categories.edit');

Route::put('/categories/{category:slug}', function () {
    return 'Categories update (placeholder)';
})->name('categories.update');

Route::delete('/categories/{category:slug}', function () {
    return 'Categories destroy (placeholder)';
})->name('categories.destroy');

// Movies
Route::get('/movies', function () {
    return 'Movies index (placeholder)';
})->name('movies.index');

Route::get('/movies/create', function () {
    return 'Movies create (placeholder)';
})->name('movies.create');

Route::post('/movies', function () {
    return 'Movies store (placeholder)';
})->name('movies.store');

Route::get('/movies/{movie:slug}', function () {
    return 'Movies show (placeholder)';
})->name('movies.show');

Route::get('/movies/{movie:slug}/edit', function () {
    return 'Movies edit (placeholder)';
})->name('movies.edit');

Route::put('/movies/{movie:slug}', function () {
    return 'Movies update (placeholder)';
})->name('movies.update');

Route::delete('/movies/{movie:slug}', function () {
    return 'Movies destroy (placeholder)';
})->name('movies.destroy');

// Reviews
Route::post('/movies/{movie:slug}/reviews', function () {
    return 'Reviews store (placeholder)';
})->name('reviews.store');

Route::get('/movies/{movie:slug}/reviews/{review}/edit', function () {
    return 'Reviews edit (placeholder)';
})->name('reviews.edit');

Route::put('/movies/{movie:slug}/reviews/{review}', function () {
    return 'Reviews update (placeholder)';
})->name('reviews.update');

Route::delete('/movies/{movie:slug}/reviews/{review}', function () {
    return 'Reviews destroy (placeholder)';
})->name('reviews.destroy');