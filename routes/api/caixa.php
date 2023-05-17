<?php

use App\Http\Controllers\Api\ApiCaixaController;
use Illuminate\Support\Facades\Route;

Route::controller(ApiCaixaController::class)->prefix('caixa')->withoutMiddleware("throttle:api")
    ->middleware("throttle:1000:1")->group(function () {
        Route::post('/cadastro', 'cadastro');
    });
