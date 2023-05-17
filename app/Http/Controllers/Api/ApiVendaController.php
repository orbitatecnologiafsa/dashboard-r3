<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositorio\Api\ApiVendaRepositorio;
use Illuminate\Http\Request;

class ApiVendaController extends Controller
{
    protected $apiRepositorio;

    public function __construct()
    {
        $this->apiRepositorio = new ApiVendaRepositorio();
    }

    public function cadastro(Request $request)
    {

        return $this->apiRepositorio->cadastro($request->all());
    }
}
