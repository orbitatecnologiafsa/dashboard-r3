<?php

use App\Http\Controllers\Api\ApiUsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/teste',function(){
    return view('tamplate.main');
});

require __DIR__.'/login/login.php';
//usuario
require __DIR__.'/usuario/usuario-master.php';
require __DIR__.'/adm/adm-master.php';

