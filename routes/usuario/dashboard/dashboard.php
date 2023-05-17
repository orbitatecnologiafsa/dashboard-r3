<?php

use App\Http\Controllers\Usuario\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

//dashboard
Route::middleware('is_user')->controller(DashboardController::class)->prefix('user')->group(function(){
    Route::get('/dashboard','dashboard')->name('user-dashboard');
    Route::get('/last-update','ultimaAutalizacao')->name('user-ultimo-update');
    Route::get('/grafico-info','grafico')->name('user-grafico-info');
    Route::get('/filtro-venda','filtro_venda')->name('filto-vendas');
});


