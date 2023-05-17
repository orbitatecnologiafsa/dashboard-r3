<?php

namespace App\Http\Controllers\Adm\Caixa;

use App\Http\Controllers\Controller;
use App\Repositorio\Caixa\CaixaRepositorio;
use Illuminate\Http\Request;

class CaixaController extends Controller
{
    protected $caixaRepositorio;

    public function __construct()
    {
        $this->caixaRepositorio = new CaixaRepositorio();
    }

    public function getLista()
    {
       
        dd($this->caixaRepositorio->caixa());
    }
}
