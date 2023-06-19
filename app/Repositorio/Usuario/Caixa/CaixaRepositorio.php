<?php



namespace App\Repositorio\Usuario\Caixa;

use App\Models\Caixa;
use App\Repositorio\Database\DatabaseRepositorio;
use App\Repositorio\Usuario\VendaProduto\VendaProduto;
use App\Repositorio\Util\HelperUtil;
use Illuminate\Support\Facades\DB;


class CaixaRepositorio
{
    protected $database;
    protected $caixa;
    protected $db;
    protected $produtos;

    public function __construct()
    {
        $this->caixa = new Caixa();
        $this->db = new DB();
        $this->produtos = new VendaProduto();
    }




    public function lista()
    {

        return $this->caixa->orderBy('codigo', 'desc')->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor', '!=', 0)->paginate(9);
    }

    public function buscaCaixa($inicio, $fim, $codigo = '')
    {
        $busca = '';
        $total = 0;
        if (!empty($codigo)) {
            $busca = $this->caixa->where('codigo', 'LIKE', '%' . $codigo . '%')->OrWhere('codcaixa', 'LIKE', '%' . $codigo . '%')
                ->where('codoperador', 'LIKE', '%' . $codigo . '%')->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor', '!=', 0)
                ->paginate(5);

            $total = $this->caixa->where('codigo', 'LIKE', '%' . $codigo . '%')->OrWhere('codcaixa', 'LIKE', '%' . $codigo . '%')
                ->where('codoperador', 'LIKE', '%' . $codigo . '%')->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor', '!=', 0)
                ->sum('valor');
            if(count($busca) == 0){
                $busca = $this->caixa->where('codigo_venda', 'LIKE', '%' . $codigo . '%')->OrWhere('codcaixa', 'LIKE', '%' . $codigo . '%')
                ->where('codigo_venda', 'LIKE', '%' . $codigo . '%')->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor', '!=', 0)
                ->paginate(5);

            $total = $this->caixa->where('codigo_venda', 'LIKE', '%' . $codigo . '%')->OrWhere('codcaixa', 'LIKE', '%' . $codigo . '%')
                ->where('codigo_venda', 'LIKE', '%' . $codigo . '%')->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor', '!=', 0)
                ->sum('valor');
            }
        } else {
            $busca = $this->caixa->whereBetween('data', [$inicio . ' 00:00:00', $fim . ' 23:00:00'])->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor', '!=', 0)
                ->paginate(9);
            $total = $this->caixa->whereBetween('data', [$inicio . ' 00:00:00', $fim . ' 23:00:00'])->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor', '!=', 0)
                ->sum('valor');
        }
         $res = ['busca' => $busca,'total_periodo' => $total];
        return  count($busca) > 0 ? $res :  false;
    }

    public function buscaCaixaID($id)
    {
        $busca = '';
        $res = [];
        $total = 0;

        if (!empty($id)) {
            $busca = $this->caixa->where('id', $id)->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('valor', '!=', 0)
                ->get()->first();
            $produtos = $this->produtos->getListaProdutoByCodNota($busca->codigo_venda);
            $total = $this->caixa->where('id', $id)->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->sum('valor');
        }
        $res = [
            'busca' => $busca,
            'produtos' => $produtos,
            'total' => $total
        ];
        return  !empty($busca) ? $res :  false;
    }
}
