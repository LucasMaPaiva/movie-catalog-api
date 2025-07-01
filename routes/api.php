<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login'])->name('auth.login');
        Route::post('register', [AuthController::class, 'register'])->name('auth.register');
    });

    Route::prefix('movies')->group(function () {
        Route::get('popular', [MovieController::class, 'showPopular'])->name('movies.popular');
        Route::get('top_rated', [MovieController::class, 'showTopRated'])->name('movies.top_rated');
        Route::get('search', [MovieController::class, 'searchMovie'])->name('movies.search');
    });

});
