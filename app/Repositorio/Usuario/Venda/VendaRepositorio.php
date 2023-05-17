<?php



namespace App\Repositorio\Usuario\Venda;

use App\Models\Venda;
use App\Repositorio\Database\DatabaseRepositorio;
use App\Repositorio\Util\HelperUtil;
use Illuminate\Support\Facades\DB;


class VendaRepositorio
{
    protected $database;
    protected $venda;
    protected $db;

    public function __construct()
    {
        $this->venda = new Venda();
        $this->db = new DB();
    }



    public function lista()
    {

        return $this->venda->orderBy('codigo', 'desc')->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('total_nota','!=',0)->paginate(9);
    }

    public function buscarVenda($inicio, $fim)
    {
        $busca = '';


            $busca = $this->venda->whereBetween('data', [$inicio . ' 00:00:00', $fim . ' 23:00:00'])->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('total_nota','!=',0)
                ->paginate(9);


        return  count($busca) > 0 ? $busca :  false;
    }

    public function buscaVendaID($id)
    {
        $busca = '';


        if (!empty($id)) {
            $busca = $this->venda->where('id', $id)->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('total_nota','!=',0)
                ->get()->first();
        }

        return  !empty($busca) ? $busca :  false;
    }

    public function buscarVendaFiltro($coluna,$valor)
    {

        $busca = '';


        if(empty($coluna) || empty($valor)){
            return false;
        }

        $busca = $this->venda->where($coluna, 'LIKE', '%' . $valor . '%')->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('total_nota','!=',0)->paginate(9);

        return  count($busca) > 0 ? $busca :  false;

    }
}
