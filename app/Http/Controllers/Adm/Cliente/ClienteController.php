<?php

namespace App\Http\Controllers\Adm\Cliente;

use App\Http\Controllers\Controller;
use App\Http\Requests\Adm\ClienteRequest;
use App\Repositorio\Adm\ClienteRepositorio;


class ClienteController extends Controller
{
    protected $path;
    protected $admRepositorio;
    public function __construct()
    {
        $this->path = 'adm/';
        $this->admRepositorio = new ClienteRepositorio();
    }

    public function lista()
    {
        return view($this->path . 'cliente/lista', ['users' => $this->admRepositorio->listaUsuario()]);
    }

    public function cadastar()
    {
        return view($this->path . 'cliente/cadastar');
    }

    public function atualizar(ClienteRequest $req, $id)
    {
        if ($this->admRepositorio->atualizarusUario($req->all(), $id)) {
            return redirect()->to("adm/cliente/detalhes/$id")->with('msg-success', 'Cliente atualizado com sucesso!');
        }
        return redirect()->back()->with('msg-error', 'Erro ao atualizar cliente!');
    }
    public function detalhes($id)
    {
        if ($detalhes = $this->admRepositorio->detalhesUsuario($id)) {

            return view($this->path . 'cliente/detalhes', ['users' => $detalhes]);
        }
        return redirect()->back()->with('msg-error', 'Erro cliente não encontrado!');
    }

    public function cadastrarPost(ClienteRequest $req)
    {

        if ($this->admRepositorio->cadastarUsuario($req->all())) {
            return redirect()->back()->with('msg-success', 'Cliente cadastrado com sucesso!');
        }
        return redirect()->back()->with('msg-error', 'Erro ao cadastar cliente!');
    }

    public function listaLoja()
    {

        return view($this->path . 'cliente/lista-loja', ['lojas' => $this->admRepositorio->listaLoja()]);
    }
    // deletarCliente

    public function deletarCliente($id)
    {
        if ($this->admRepositorio->deletarCliente($id)) {
            return redirect()->to("adm/cliente/lista")->with('msg-success', 'Cliente deletado com sucesso!');
        }else{
            return redirect()->back()->with('msg-error', 'Erro ao deletar cliente!');
        }

    }
}
