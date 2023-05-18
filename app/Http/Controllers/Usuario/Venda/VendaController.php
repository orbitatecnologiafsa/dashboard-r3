<?php

namespace App\Http\Controllers\Usuario\Venda;

use App\Http\Controllers\Controller;
use App\Http\Requests\Venda\VendaRequest;
use App\Repositorio\Usuario\Venda\VendaRepositorio;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    protected $vendaRepositorio;
    protected $path;
    protected $prefix;

    public function __construct()
    {
        $this->vendaRepositorio = new VendaRepositorio();
        $this->path = "usuario.venda";
        $this->prefix = "user";
    }

    public function lista()
    {

        return view($this->path . '.lista', ['venda' => $this->vendaRepositorio->lista()]);
    }

    public function buscarVenda(VendaRequest $req)
    {

        if ($busca = $this->vendaRepositorio->buscarVenda($req->input('data_inicio'), $req->input('data_fim'))) {
            return view($this->path . '.lista', ['venda' => $busca]);
        }
        return redirect()->route('user-lista-vendas')->with('msg-error', 'Não foram encontrados registros!')->withInput();
    }

    public function detalhesVenda($id)
    {
        if ($busca =  $this->vendaRepositorio->buscaVendaID($id)) {
            return view($this->path . '.detalhes', ['venda' => $busca]);
        }
        return redirect()->route('user-lista-vendas')->with('msg-error', 'Não foram encontrados registros durante esse periodo!')->withInput();
    }

    public function buscaFiltro(Request $req)
    {

        if ($busca = $this->vendaRepositorio->buscarVendaFiltro($req->all())) {
            return view($this->path . '.lista', ['venda' => $busca]);
        }
        return redirect()->route('user-lista-vendas')->with('msg-error', 'Não foram encontrados registros!')->withInput();

    }
}
