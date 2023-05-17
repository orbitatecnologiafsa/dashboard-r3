<?php

use App\Http\Controllers\Usuario\Caixa\CaixaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->controller(CaixaController::class)->prefix('user')->group(function(){
        Route::get('/caixas','getLista')->name('user-lista-caixa');
        Route::get('/busca-caixa','buscarCaixa')->name('user-busca-caixa');
        Route::Get('/caixa/detalhes/{id}','detalhesCaixa')->name('user-detalhes-caixa');
});



