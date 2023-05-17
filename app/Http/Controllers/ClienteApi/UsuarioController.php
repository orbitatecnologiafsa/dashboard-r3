<?php
namespace App\Http\Controllers\ClienteApi;

use App\Repositorio\Api\UsuarioApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    protected $repositorio;
    public function __construct()
    {
        $this->repositorio = new UsuarioApi();
    }

    public function getUser(Request $req){
        return $this->repositorio->getUser($req->input('cnpj_cliente'));
    }
    
}
