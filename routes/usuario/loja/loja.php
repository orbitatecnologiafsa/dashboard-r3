<?php

use App\Http\Controllers\Usuario\Loja\LojaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->controller(LojaController::class)->prefix('user')->group(function(){
    Route::middleware('loja_on')->group(function () {
        Route::get('/lojas','lojas')->name('user-lojas');
    
    Route::get('/loja/{cnpj_loja}','lojaSelecionada')->name('user-lojas-selecionada');
});
});


