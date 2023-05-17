<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositorio\Api\ApiCaixaRepositrio;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ApiCaixaController extends Controller
{
    protected $apiRepositorio;
    public function __construct()
    {
        $this->apiRepositorio = new ApiCaixaRepositrio();
    }

    public function cadastro(Request $request)
    { 
        return $this->apiRepositorio->cadastro($request->all());
    }
}
