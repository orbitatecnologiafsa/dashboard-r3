<?php





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\ClienteApi\AuthController;
use App\Http\Controllers\ClienteApi\CaixaController;
use App\Http\Controllers\ClienteApi\EstoqueController;
use App\Http\Controllers\ClienteApi\LojaController;
use App\Http\Controllers\ClienteApi\UsuarioController;
use App\Http\Controllers\ClienteApi\VendaController;
use App\Http\Controllers\ClienteApi\VendedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->get('servidor/status', function (Request $request) {
    return ["service"=>true];
});

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');

// });
Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
    //Route::post('/user', 'user');
});

Route::middleware('is_cliente_api')->prefix('auth')->controller(UsuarioController::class)->group(function () {
    Route::post('/user', 'getUser');
});

Route::middleware('is_cliente_api')->prefix('auth')->controller(LojaController::class)->group(function () {
    Route::post('/cadastro/loja', 'cadastro');
});
Route::middleware('is_cliente_api')->prefix('auth')->controller(LojaController::class)->group(function () {
    Route::post('/atualizar/loja', 'update');
});

Route::middleware('is_cliente_api')->prefix('auth')->controller(EstoqueController::class)->group(function () {
    Route::post('/cadastro/estoque', 'cadastrar');
});
Route::middleware('is_cliente_api')->prefix('auth')->controller(EstoqueController::class)->group(function () {
    Route::post('/cadastro/estoque/delete/bigdata', 'deleteBigData');
});
Route::middleware('is_cliente_api')->prefix('auth')->controller(EstoqueController::class)->group(function () {
    Route::post('/cadastro/estoque/bigdata', 'bigDataCaixa');
});
Route::middleware('is_cliente_api')->prefix('auth')->controller(CaixaController::class)->group(function () {
    Route::post('/cadastro/caixa', 'cadastrar');
});

Route::middleware('is_cliente_api')->prefix('auth')->controller(VendedorController::class)->group(function () {
    Route::post('/cadastro/vendedor', 'cadastrar');
});

Route::middleware('is_cliente_api')->prefix('auth')->controller(CaixaController::class)->group(function () {
    Route::post('/cadastro/caixa/bigdata', 'bigDataCaixa');
});
Route::middleware('is_cliente_api')->prefix('auth')->controller(CaixaController::class)->group(function () {
    Route::post('/cadastro/caixa/delete/bigdata', 'deleteBigData');
});

Route::middleware('is_cliente_api')->prefix('auth')->controller(VendaController::class)->group(function () {
    Route::post('/cadastro/venda', 'cadastrar');
});

Route::middleware('is_cliente_api')->prefix('auth')->controller(VendaController::class)->group(function () {
    Route::post('/cadastro/venda/bigdata', 'bigDataCaixa');
});
Route::middleware('is_cliente_api')->prefix('auth')->controller(VendaController::class)->group(function () {
    Route::post('/cadastro/venda/delete/bigdata', 'deleteBigData');
});
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::prefix('servidor')->withoutMiddleware("throttle:api")
//     ->middleware("throttle:1000:1")->group(function () {
//         Route::get('/status',function(){
//             return response()->json(['service' => true]);
//         });
//     });

// require __DIR__.'/api/api-master.php';
