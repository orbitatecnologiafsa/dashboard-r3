<?php

use App\Http\Controllers\Adm\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware('is_admin')->controller(DashboardController::class)->prefix('adm')->group(function () {
   Route::get('/contador/clientes','contadorClientes')->name('adm-contador-clientes');
});
