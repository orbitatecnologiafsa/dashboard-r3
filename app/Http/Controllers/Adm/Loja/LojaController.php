<?php

namespace App\Http\Controllers\Adm\Loja;

use App\Http\Controllers\Controller;
use App\Repositorio\Loja\LojaRepositorio;
use Illuminate\Http\Request;

class LojaController extends Controller
{

    protected $lojaRepositorio;
    protected $path;

    public function __construct()
    {
        $this->lojaRepositorio = new LojaRepositorio();
        $this->path = "usuario.";
    }

    public function lojas()
    {
        return view($this->path.'loja/loja', ['lojas' => (object) $this->lojaRepositorio->lojas()]);
    }

    public function lojaSelecionada(Request $request,$cnpj_loja)
    {
        return $this->lojaRepositorio->selecionarloja($cnpj_loja) ? redirect()->to('/dashboard') : redirect()->to('/lojas');
    }
}
