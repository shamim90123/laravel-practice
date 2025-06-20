<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', [ContactController::class, 'create']);
Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');

// Authentication routes to handle GitHub login
Route::get('/auth/redirect', [App\Http\Controllers\AuthController::class, 'redirectToGithub'])->name('github.login');
Route::get('/auth/callback', [App\Http\Controllers\AuthController::class, 'handleGithubCallback']);


Route::post('/submit', function () {
    return 'Form submitted';
});

Route::get('/user/{id}', function ($id) {
    return "User ID: $id";
});

Route::get('/user/{name?}', function ($name = 'Guest') {
    return "Hello, $name";
});

Route::get('/user/{id}', function ($id) {
    return "User ID: $id";
})->where('id', '[0-9]+');


Route::get('/dashboard', function () {
    return 'Dashboard';
})->name('dashboard');

// Usage: route('dashboard') => /dashboard


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return 'Profile';
    });
});


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return 'Admin Dashboard';
    });
});


// Route::resource('posts', PostController::class);

// php artisan route:cache
// php artisan route:clear
