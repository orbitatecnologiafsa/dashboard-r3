<?php

namespace App\Http\Controllers\ClienteApi;

use App\Http\Controllers\Controller;
use App\Repositorio\Api\VendaProdutoApi;
use Illuminate\Http\Request;

class VendaProdutoController extends Controller
{
    //
    protected $repositorio;

    public function __construct()
    {
         $this->repositorio = new VendaProdutoApi();
    }

    public function cadastrar(Request $req)
    {
        return $this->repositorio->cadastrar($req->all());
    }
}
