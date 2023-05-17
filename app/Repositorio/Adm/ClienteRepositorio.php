<?php

namespace App\Repositorio\Adm;

use App\Models\Loja;
use App\Models\User;
use App\Repositorio\Util\HelperUtil;
use Illuminate\Support\Facades\DB;

class ClienteRepositorio
{


    protected $user;
    protected $loja;

    public function __construct()
    {
        $this->user = new User();
        $this->loja = new Loja();
    }

    public function cadastarUsuario($usuario)
    {
        $usuario['password'] = bcrypt($usuario['password']);
        $usuario['cnpj'] = HelperUtil::removerMascara($usuario['cnpj']);
        if ($this->user->create($usuario)) {
            return true;
        }
        return false;
    }

    public function listaUsuario()
    {
        if ($user = $this->user->paginate(5)) {
            return $user;
        }
        return [];
    }

    public function listaLoja()
    {



        if ($loja = $this->loja->join('users', 'users.cnpj', 'lojas.cnpj_cliente', 'users.cnpj')
            ->select(
                'lojas.id as loja_id',
                'lojas.nome_loja as nome_loja',
                'lojas.cnpj_loja as cnpj_loja',
                'lojas.cnpj_cliente as cnpj_cliente',
                'lojas.id_cliente as id_cliente',
                'users.id as u_id_cli',
                'users.nome_filial as u_nome_filial',
                'users.cnpj as u_cnpj'
            )

            ->paginate(6)
        ) {
            return $loja;
        }
        return [];
    }

    public function detalhesUsuario($id)
    {
        if ($user = $this->user->where('id', $id)->get()->first()) {
            return $user;
        }
        return [];
    }

    public function atualizarusUario($usuario, $id)
    {
        $user = $this->detalhesUsuario($id);
        $usuario['cnpj'] = HelperUtil::removerMascara($usuario['cnpj']);
        if ($usuario['password'] != '') {
            $usuario['password'] = bcrypt($usuario['password']);
        }
        if ($usuario['password'] == "") {
            $usuario['password'] = $user->password;
        }


        if ($this->user->where('id', $id)->first()->updateOrFail($usuario)) {
            DB::statement('SET SQL_SAFE_UPDATES = 0;');
            DB::update("update vendas set cnpj_cliente =  ? where  cnpj_cliente = ?", [$usuario['cnpj'], $user->cnpj]);
            DB::update("update lojas set cnpj_cliente =  ? where  cnpj_cliente = ?", [$usuario['cnpj'], $user->cnpj]);
            DB::update("update caixas set cnpj_cliente =  ? where  cnpj_cliente = ?", [$usuario['cnpj'], $user->cnpj]);
            DB::update("update estoques set cnpj_cliente =  ? where  cnpj_cliente =? ", [$usuario['cnpj'], $user->cnpj]);
            DB::update("update vendedores set cnpj_cliente =  ? where  cnpj_cliente =? ", [$usuario['cnpj'], $user->cnpj]);
            DB::statement('SET SQL_SAFE_UPDATES = 1;');
            return true;
        }
        return false;
    }

    public function deletarCliente($id)
    {
        $user = new User();
        $select  = $user->where('id', $id)->get()->first();
        
        if ($this->user->where('id', $id)->delete()) {
            DB::statement('SET SQL_SAFE_UPDATES = 0;');
            DB::update("delete from vendas  where  cnpj_cliente = ?", [$select->cnpj]);
            DB::update("delete from lojas  where  cnpj_cliente = ?", [$select->cnpj]);
            DB::update("delete from caixas  where  cnpj_cliente = ?", [$select->cnpj]);
            DB::update("delete from estoques  where  cnpj_cliente =? ", [$select->cnpj]);
            DB::update("delete from vendedores  where  cnpj_cliente =? ", [$select->cnpj]);
            DB::statement('SET SQL_SAFE_UPDATES = 1;');
            return true;
        }
        return false;
    }
}
