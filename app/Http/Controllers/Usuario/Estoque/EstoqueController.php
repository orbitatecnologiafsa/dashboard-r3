<?php

namespace App\Http\Controllers\Usuario\Estoque;

use App\Http\Controllers\Controller;
use App\Http\Requests\Estoque\EstoqueRequest;
use App\Repositorio\Usuario\Estoque\EstoqueRepositorio;
use Illuminate\Http\Request;


class EstoqueController extends Controller
{
    protected $path;
    protected $prefix;
    protected $estoqueRepositorio;

    public function __construct()
    {
        $this->prefix = 'user';
        $this->path = 'usuario.estoque';
        $this->estoqueRepositorio = new EstoqueRepositorio();
    }

    public function lista()
    {
        return view($this->path . '.lista', ['estoque' => $this->estoqueRepositorio->lista(), 'contador' => $this->estoqueRepositorio->contador()]);
    }

    public function buscarProduto(EstoqueRequest $req)
    {

        if ($busca = $this->estoqueRepositorio->buscarProduto($req->input('busca_produto'))) {
            return view($this->path . '.lista', ['estoque' => $busca, 'contador' => $this->estoqueRepositorio->contador()]);
        }
        return redirect()->route('user-lista-estoque')->with('msg-error', 'Erro ao buscar produto, codigo ou nome não existe!')->withInput();
    }


    public function detalhesEstoque($id)
    {

        if ($busca =  $this->estoqueRepositorio->detalhesEstoque($id)) {
           
            return view($this->path . '.detalhes', ['estoque' => $busca]);
        }
        return redirect()->route('user-lista-estoque')->with('msg-error', 'Não foram encontrados registros durante esse periodo!')->withInput();
    }
}
