<?php

namespace App\Http\Controllers\Usuario\Caixa;

use App\Http\Controllers\Controller;
use App\Http\Requests\Caixa\CaixaRequest;
use App\Repositorio\Usuario\Caixa\CaixaRepositorio;
use Illuminate\Http\Request;

class CaixaController extends Controller
{
    protected $caixaRepositorio;
    protected $path;
    protected $prefix;

    public function __construct()
    {
        $this->prefix = 'user';
        $this->path = 'usuario.caixa';
        $this->caixaRepositorio = new CaixaRepositorio();
    }

    public function getLista()
    {

        return view($this->path . '.lista', ['caixa' => $this->caixaRepositorio->lista(), 'contador' => 0 , 'total_periodo_caixa' => 0]);
    }

    //buscarCaixa

    public function buscarCaixa(CaixaRequest $req)
    {


        if ($busca =  $this->caixaRepositorio->buscaCaixa($req->input('data_inicio'), $req->input('data_fim'), $req->input('codigo_caixa'))) {
            return view($this->path . '.lista', ['caixa' => $busca['busca'], 'total_periodo_caixa' => $busca['total_periodo']]);
        }
        return redirect()->route('user-lista-caixa')->with('msg-error', 'Não foram encontrados registros durante esse periodo!')->withInput();
    }

    public function detalhesCaixa($id)
    {
        if ($busca =  $this->caixaRepositorio->buscaCaixaID($id)) {

            return view($this->path . '.detalhes', ['caixa' => $busca['busca'],'produtos' => $busca['produtos']['busca'],'total_periodo_caixa' => $busca['total']]);
        }
        return redirect()->route('user-lista-caixa')->with('msg-error', 'Não foram encontrados registros durante esse periodo!')->withInput();
    }
}
