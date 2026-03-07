<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\auth\UserAuthController;

    Route::controller(UserAuthController::class)->group(function () {
        Route::post('/register', 'register');
        Route::post('/login', 'login');
        Route::get('/logout', 'logout');
        Route::get('/user', 'user');
    });