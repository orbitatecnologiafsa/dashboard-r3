<?php

namespace App\Http\Controllers\ClienteApi;

use App\Http\Controllers\Controller;
use App\Repositorio\Api\VendaDiaApi;
use Illuminate\Http\Request;

class VendaDiaController extends Controller
{
    protected $repositorio;

    public function __construct()
    {
         $this->repositorio = new VendaDiaApi();
    }

    public function cadastrar(Request $req)
    {
        return $this->repositorio->cadastrar($req->all());
    }
}
