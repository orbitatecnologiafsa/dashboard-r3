<?php

use App\Http\Controllers\Adm\Cliente\ClienteController;
use Illuminate\Support\Facades\Route;

Route::middleware('is_admin')->controller(ClienteController::class)->prefix('adm')->group(function () {
    Route::get('/cliente/cadastro', 'cadastar')->name('adm-cadastro-cliente');
    Route::get('/cliente/lista', 'lista')->name('adm-lista-cliente');
    Route::post('/cliente/cadastro', 'cadastrarPost')->name('adm-cadastro-cliente-post');
    Route::put('/cliente/atualizar/{id}', 'atualizar')->name('adm-atualizar-cliente-put');
    Route::get('/cliente/detalhes/{id}','detalhes')->name('adm-cliente-detalhes');

    Route::get('/lista/loja','listaLoja')->name('adm-lista-loja');
});
