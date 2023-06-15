<?php



namespace App\Repositorio\Usuario\Venda;

use App\Models\Venda;
use App\Models\Vendedor;

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

        return $this->venda->orderBy('codigo', 'desc')->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('total_nota', '!=', 0)->paginate(9);
    }

    public function buscarVenda($inicio, $fim)
    {
        $busca = '';


        $busca = $this->venda->whereBetween('data', [$inicio . ' 00:00:00', $fim . ' 23:00:00'])->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('total_nota', '!=', 0)
            ->paginate(9);


        return  count($busca) > 0 ? $busca :  false;
    }

    public function buscaVendaID($id)
    {
        $busca = '';


        if (!empty($id)) {
            $busca = $this->venda->where('id', $id)->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('total_nota', '!=', 0)
                ->get()->first();
        }

        return  !empty($busca) ? $busca :  false;
    }

    public function buscarVendaFiltro($campos)
    {

        $dados = (object) $campos;
        $total = 0;
        switch ($dados) {
            case !empty($dados->data_inicio) && !empty($dados->data_fim) && empty($dados->filtro_vendas) && !isset($dados->op_filtro_vendedor):

                $busca = $this->venda->whereBetween('data', [$dados->data_inicio . ' 00:00:00', $dados->data_fim . ' 23:00:00'])
                    ->where('cnpj_cliente', HelperUtil::userInformation())
                    ->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
                    ->where('total_nota', '!=', 0)
                    ->paginate(9);
                $total = $this->venda->whereBetween('data', [$dados->data_inicio . ' 00:00:00', $dados->data_fim . ' 23:00:00'])
                    ->where('cnpj_cliente', HelperUtil::userInformation())
                    ->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
                    ->where('total_nota', '!=', 0)->sum('total_nota');
                $res = ['busca' => $busca, 'total_periodo' => $total];
                return  count($busca) > 0 ? $res :  false;
                break;
            case !empty($dados->data_inicio) && !empty($dados->data_fim) && !empty($dados->op_filtro_venda) && !empty($dados->filtro_vendas) && !isset($dados->op_filtro_vendedor):
                $busca = $this->venda->whereBetween('data', [$dados->data_inicio . ' 00:00:00', $dados->data_fim . ' 23:00:00'])
                    ->where("{$dados->op_filtro_venda}", $dados->filtro_vendas)
                    ->where('cnpj_cliente', HelperUtil::userInformation())
                    ->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
                    ->where('total_nota', '!=', 0)
                    ->paginate(9);
                $total = $this->venda->whereBetween('data', [$dados->data_inicio . ' 00:00:00', $dados->data_fim . ' 23:00:00'])
                    ->where("{$dados->op_filtro_venda}", $dados->filtro_vendas)
                    ->where('cnpj_cliente', HelperUtil::userInformation())
                    ->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
                    ->where('total_nota', '!=', 0)
                    ->sum('total_nota');
                $res = ['busca' => $busca, 'total_periodo' => $total];
                return  count($busca) > 0 ? $res :  false;
                break;
            case !empty($dados->data_inicio) && !empty($dados->data_fim) && isset($dados->op_filtro_vendedor)  && !empty($dados->op_filtro_vendedor)  &&  empty($dados->filtro_vendas):

                $busca = $this->venda->whereBetween('data', [$dados->data_inicio . ' 00:00:00', $dados->data_fim . ' 23:00:00'])
                    ->where("codvendedor", $dados->op_filtro_vendedor)
                    ->where('cnpj_cliente', HelperUtil::userInformation())
                    ->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
                    ->where('total_nota', '!=', 0)
                    ->paginate(9);
                $total = $this->venda->whereBetween('data', [$dados->data_inicio . ' 00:00:00', $dados->data_fim . ' 23:00:00'])
                    ->where("codvendedor", $dados->op_filtro_vendedor)
                    ->where('cnpj_cliente', HelperUtil::userInformation())
                    ->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
                    ->where('total_nota', '!=', 0)
                    ->sum('total_nota');
                    $res = ['busca' => $busca, 'total_periodo' => $total];
                    return  count($busca) > 0 ? $res :  false;
                break;
            case empty($dados->data_inicio) && empty($dados->data_fim) && !isset($dados->op_filtro_vendedor) && !empty($dados->filtro_vendas):

                $busca = $this->venda->where("{$dados->op_filtro_venda}", 'LIKE', '%' . $dados->filtro_vendas . '%')
                    ->where('cnpj_cliente', HelperUtil::userInformation())
                    ->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
                    ->where('total_nota', '!=', 0)
                    ->paginate(9);
                $total = $this->venda->where("{$dados->op_filtro_venda}", 'LIKE', '%' . $dados->filtro_vendas . '%')
                ->where('cnpj_cliente', HelperUtil::userInformation())
                ->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
                ->where('total_nota', '!=', 0)
                ->sum('total_nota');
                $res = ['busca' => $busca, 'total_periodo' => $total];
                return  count($busca) > 0 ? $res :  false;
                break;
            case empty($dados->data_inicio) && empty($dados->data_fim) && isset($dados->op_filtro_vendedor) && isset($dados->op_filtro_vendedor) && empty($dados->filtro_vendas) || !empty($dados->filtro_vendas):
                $busca = $this->venda->where("codvendedor", 'LIKE', '%' . $dados->op_filtro_vendedor . '%')
                    ->where('cnpj_cliente', HelperUtil::userInformation())
                    ->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
                    ->where('total_nota', '!=', 0)
                    ->paginate(9);
                $total = $this->venda->where("codvendedor", 'LIKE', '%' . $dados->op_filtro_vendedor . '%')
                ->where('cnpj_cliente', HelperUtil::userInformation())
                ->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)
                ->where('total_nota', '!=', 0)
                ->sum('total_nota');
                $res = ['busca' => $busca, 'total_periodo' => $total];
                return  count($busca) > 0 ? $res :  false;
                break;
            default:
                return false;
                break;
        }



        // $busca = $this->venda->where($coluna, 'LIKE', '%' . $valor . '%')->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('total_nota','!=',0)->paginate(9);

        // return  count($busca) > 0 ? $busca :  false;

    }

    public function filtros_vendedor()
    {

        $select = new Vendedor();
        $res = $select->all([
            'nome_vendedor',
            'codigo_vendedor'
        ]);

        return $res;
    }
}
