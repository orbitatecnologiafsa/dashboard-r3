<?php


use App\Http\Controllers\Api\ApiEstoqueController;
use Illuminate\Support\Facades\Route;

Route::controller(ApiEstoqueController::class)->prefix('estoque')->withoutMiddleware("throttle:api")
    ->middleware("throttle:1000:1")->group(function () {
        Route::post('/cadastro', 'cadastro');
});
