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
