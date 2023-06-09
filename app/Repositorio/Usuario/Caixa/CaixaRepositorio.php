<?php



namespace App\Repositorio\Usuario\Caixa;

use App\Models\Caixa;
use App\Repositorio\Database\DatabaseRepositorio;
use App\Repositorio\Util\HelperUtil;
use Illuminate\Support\Facades\DB;


class CaixaRepositorio
{
    protected $database;
    protected $caixa;
    protected $db;

    public function __construct()
    {
        $this->caixa = new Caixa();
        $this->db = new DB();
    }




    public function lista()
    {

        return $this->caixa->orderBy('codigo', 'desc')->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor','!=',0)->paginate(9);
    }

    public function buscaCaixa($inicio, $fim, $codigo = '')
    {
        $busca = '';

        if (!empty($codigo)) {
            $busca = $this->caixa->where('codigo', 'LIKE', '%' . $codigo . '%')->OrWhere('codcaixa', 'LIKE', '%' . $codigo . '%')
                ->where('codoperador', 'LIKE', '%' . $codigo . '%')->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor','!=',0)
                ->paginate(5);
        } else {
            $busca = $this->caixa->whereBetween('data', [$inicio . ' 00:00:00', $fim . ' 23:00:00'])->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor','!=',0)
                ->paginate(9);
        }

        return  count($busca) > 0 ? $busca :  false;
    }

    public function buscaCaixaID($id)
    {
        $busca = '';


        if (!empty($id)) {
            $busca = $this->caixa->where('id', $id)->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor','!=',0)
                ->get()->first();
        }

        return  !empty($busca) ? $busca :  false;
    }
}
