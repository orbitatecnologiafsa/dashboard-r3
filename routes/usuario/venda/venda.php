<?php

use App\Http\Controllers\Usuario\Venda\VendaController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->controller(VendaController::class)->prefix('user')->group(function () {
    Route::get('/vendas','lista')->name('user-lista-vendas');
    Route::get('/busca-venda','buscarVenda')->name('user-busca-venda');
    Route::get('/vendas/detalhes/{id}','detalhesVenda')->name('user-detalhes-venda');
    Route::get('/vendas/filtro','buscaFiltro')->name('user-filtro-vendas');
});
