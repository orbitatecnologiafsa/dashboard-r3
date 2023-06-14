<?php

namespace App\Http\Controllers\ClienteApi;

use App\Http\Controllers\Controller;
use App\Repositorio\Api\VendaAnoApi;
use Illuminate\Http\Request;

class VendaAnoController extends Controller
{
    protected $repositorio;

    public function __construct()
    {
         $this->repositorio = new VendaAnoApi();
    }

    public function cadastrar(Request $req)
    {
        return $this->repositorio->cadastrar($req->all());
    }
}
