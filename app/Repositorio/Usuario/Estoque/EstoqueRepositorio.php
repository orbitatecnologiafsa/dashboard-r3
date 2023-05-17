<?php

namespace App\Repositorio\Usuario\Estoque;

use Illuminate\Support\Facades\DB;

use App\Models\Estoque;
use App\Repositorio\Util\HelperUtil;

class EstoqueRepositorio
{
    protected $estoque;
    protected $db;

    public function __construct()
    {
        $this->estoque = new Estoque();
        $this->db = new DB();
    }



    public function lista()
    {

        return $this->estoque->orderBy('codigo', 'DESC')->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->paginate(9);
    }
    public function contador()
    {

        return $this->estoque->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->count('id');
    }

    public function ultimaAtualizacao()
    {
      //  ->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
        $busca = $this->db::select("select created_at as data from vendas  where cnpj_loja = ? and cnpj_cliente  = ? limit 1",[HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja,HelperUtil::userInformation()]);
        return $busca[0]->data;
    }

    public function detalhesEstoque($id)
    {

        $busca = $this->estoque->where('id', $id)->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->get()->first();
        return !empty($busca) ? $busca : false;
    }

    public function buscarProduto($produto)
    {

        $busca = $this->estoque->where('produto', 'LIKE', '%' . $produto . '%')
            ->orWhere('codigo', 'LIKE', '%' . $produto . '%')->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
            ->paginate(5);

        return  count($busca) > 0 ? $busca :  false;
    }
}
