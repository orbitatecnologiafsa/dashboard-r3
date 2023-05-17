<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositorio\Api\ApiEstoqueRepositorio;
use Illuminate\Http\Request;

class ApiEstoqueController extends Controller
{
    protected $apiRepositorio;
    public function __construct()
    {
        $this->apiRepositorio = new ApiEstoqueRepositorio();
    }

    public function cadastro(Request $request)
    { 
        return $this->apiRepositorio->cadastro($request->all());
    }
}
