<?php

namespace App\Http\Controllers\ClienteApi;

use App\Repositorio\Api\LojaApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LojaController extends Controller
{
    protected $repositorio;

    public function __construct()
    {
        $this->repositorio = new LojaApi();
    }

    public function cadastro(Request $req)
    {
        return $this->repositorio->cadastro($req->all());
    }
    public function update(Request $req)
    {
        return $this->repositorio->atualizar($req->all());
    }
}
