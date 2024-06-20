<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/invalidate', function () {
    return session()->invalidate();
});

Route::get('/all', function () {
    return session()->all();
});

Route::get('/', function () {
    return to_route('/login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('admin',UserController::class);

Route::resource('categories',CategoryController::class)->only('index');

Route::resource('dishes',CategoryController::class)->only('index');
