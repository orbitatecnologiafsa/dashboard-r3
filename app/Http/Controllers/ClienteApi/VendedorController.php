<?php

namespace App\Http\Controllers\ClienteApi;

use App\Http\Controllers\Controller;
use App\Repositorio\Api\VendedorApi;
use Illuminate\Http\Request;

class VendedorController extends Controller
{
    protected $repositorio;

    public function __construct()
    {
         $this->repositorio = new VendedorApi();
    }


    public function cadastrar(Request $req)
    {
        return $this->repositorio->cadastrar($req->all());
    }
}
