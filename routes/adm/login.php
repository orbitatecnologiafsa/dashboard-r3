<?php

use App\Http\Controllers\Adm\Login\LoginController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:admin')->controller(LoginController::class)->prefix('adm')->group(function () {
    Route::get('/login', 'login')->name('adm-login');
    Route::post('/login', 'loginIn')->name('adm-login-post');
});

Route::middleware('is_admin')->controller(LoginController::class)->group(function () {
    Route::post('/logout', 'logout')->name('adm-logout');
});
