<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositorio\Api\ApiLojaRepositorio;
use App\Repositorio\Api\LojaApi;
use Illuminate\Http\Request;

class ApiLojaController extends Controller
{
    protected $apiRepositorio;
    public function __construct()
    {
        $this->apiRepositorio = new LojaApi();
    }

    public function cadastro(Request $request)
    {
        return $this->apiRepositorio->cadastro($request->all());
    }
    public function update(Request $request)
    {
        return $this->apiRepositorio->atualizar($request->all());
    }
}
