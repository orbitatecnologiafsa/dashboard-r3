<?php

namespace App\Http\Controllers\ClienteApi;

use App\Repositorio\Api\EstoqueApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstoqueController extends Controller
{
    protected $repositorio;

    public function __construct()
    {
         $this->repositorio = new EstoqueApi();
    }


    public function cadastrar(Request $req)
    {
        return $this->repositorio->cadastrar($req->all());
    }

    public function bigDataCaixa(Request $req)
    {
         return $this->repositorio->cadastrarBigData($req->all());
    }

    public function deleteBigData(Request $req){
        return $this->repositorio->deleteBigData($req->input('cnpj_loja'),$req->input('cnpj_cliente'));
    }
}
