<?php

namespace App\Repositorio\Usuario\Dashboard;

use App\Models\Caixa;
use App\Models\Estoque;
use App\Models\Loja;
use Illuminate\Support\Facades\DB;
use App\Models\Venda;
use App\Models\Vendedor;
use App\Repositorio\Util\HelperUtil;

class DashboardRepositorio
{
    protected $estoque;
    protected $caixa;
    protected $venda;
    protected $db;
    protected $loja;


    public function __construct($cnpj_cliente = '',$cnpj_loja = '')
    {
        $this->estoque = new Estoque();
        $this->caixa = new Caixa();
        $this->venda = new Venda();
        $this->db = new DB();
        $this->loja = new Loja();
    }


    public function lojaInformation($coluna)
    {
        return $this->loja->where('cnpj_loja', session()->get('cnpj_loja'))->get($coluna);
    }

    protected function userInformation()
    {
        return auth()->user()->cnpj;
    }



    public function contadorEstoque()
    {

        return $this->estoque->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->sum('precovenda');
    }
    public function contadorVendas()
    {

        return $this->venda->whereDay('data', '=', date('d'))->whewYear('data', '=', date('Y'))->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->sum('id');
    }

    public function contadorCaixa()
    {

        return $this->caixa->whereYear('data', date('Y'))->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->sum('valor');
    }

    public function contadorCaixaAtual()
    {

        $data =  date('Y-m-d');
        return $this->venda->whereBetween('data', ["{$data} 00:00:00", "{$data} 23:00:00"])->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->sum('meio_dinheiro');
    }

    public function contadorValorTotalDiario()
    {

        $data =  date('Y-m-d');
        return $this->venda->whereBetween('data', ["{$data} 00:00:00", "{$data} 23:00:00"])->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->sum('total_nota');
    }

    public function contadorTotalVendas()
    {

        //date('Y-m-d')
        $ano = date('Y');
        $dia = date('d');
        $mes = date('m');
        $cnpj_loja = HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja;
        $cnpj_cliente = HelperUtil::userInformation();
        $busca = $this->db::select("SELECT sum(total_nota) as total
        FROM vendas where year(data) = {$ano} and day(data) = {$dia} and month(data) = {$mes} and cnpj_loja = '{$cnpj_loja}' and cnpj_cliente = '{$cnpj_cliente}'")[0]->total;
        return is_null($busca) ? 0 : $busca;
        // return $this->venda->whereDay('data', '=', date('d'))->whewYear('data', '=', date('Y'))->sum('id');

        // return $this->venda->whereDay('data', date('d'))->whereYear('data', date('Y'))->sum('total_nota');
    }

    public function grafico()
    {
        $arr = [
            'meses' =>  $this->messes(),
            'valor' =>  $this->TotalMesses()
        ];

        return $arr;
    }

    protected  function messes()
    {


        $ano =  date('Y');
        // $busca = $this->db::select("SELECT CONCAT(month(data)) mes, COUNT(id) qtde, year(data)
        // FROM vendas where year(data) = {$ano}
        // GROUP BY YEAR(data), MONTH(data),id;");
        $cnpj_loja = HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja;
        $cnpj_cliente = HelperUtil::userInformation();

        $busca = $this->db::select("SELECT YEAR(data) AS ano, MONTH(data) AS mes, SUM(total_nota) AS total_vendas, count(id) as qtde
        FROM vendas where year(data) = {$ano} and cnpj_loja = '{$cnpj_loja}' and cnpj_cliente = '{$cnpj_cliente}'  and total_nota != 0
        GROUP BY ano, mes order by mes asc;");

        $valor = '';
        $format = [];

        foreach ($busca as $item) {
            $format[$item->mes] =
                [
                    "mes" => $item->mes,
                    "qtde" => $item->qtde
                ];
        }


        for ($i = 1; $i <= 12; $i++) {
            $valor .= $this->calcular(isset($format[$i]['qtde']) ? $format[$i]['qtde'] : '') . ",";
        }


        return '[' . rtrim($valor, ',') . ']';
    }

    protected function calcular($v)
    {
        return empty($v) ? 0 : $v;
    }
    public function ultimaAtualizacao()
    {

        $busca = $this->db::select('select created_at as data from vendas  where cnpj_loja = ? and cnpj_cliente  = ? limit 1' ,[HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja,HelperUtil::userInformation()]);
        if (empty($busca)) {
            $busca = $this->db::select('select created_at as data from estoques where cnpj_loja = ? and cnpj_cliente  = ? limit 1' ,[HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja,HelperUtil::userInformation()]);
        }
        return  isset($busca[0]->data) ? $busca[0]->data : 0;
    }



    protected  function TotalMesses()
    {

        $ano =  date('Y');
        // $busca = $this->db::select("SELECT CONCAT(month(data)) mes, COUNT(id) qtde, year(data),sum(total_nota) as total
        // FROM vendas where year(data) = {$ano}
        // GROUP BY YEAR(data), MONTH(data), id;");
        $valor = '';
        $cnpj_loja = HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja;
        $cnpj_cliente = HelperUtil::userInformation();
        $busca = $this->db::select("SELECT YEAR(data) AS ano, MONTH(data) AS mes, SUM(total_nota) AS total, count(id) as qtde
        FROM vendas where year(data) = {$ano} and cnpj_loja = '{$cnpj_loja}' and cnpj_cliente = '{$cnpj_cliente}' and total_nota != 0
        GROUP BY ano, mes order by mes asc;");

        $format = [];

        foreach ($busca as $item) {
            $format[$item->mes] =
                [
                    "mes" => $item->mes,
                    "total" => $item->total
                ];
        }


        for ($i = 1; $i <= 12; $i++) {
            $valor .= $this->calcular(isset($format[$i]['total']) ? $format[$i]['total'] : '') . ",";
        }



        return  '[' .  rtrim($valor, ',') . ']';
    }

    public function vendaDiaria()
    {
        $data =  date('Y-m-d');
        $busca = (object) [];

        $busca = $this->venda->whereBetween('data', ["{$data} 00:00:00", "{$data} 23:00:00"])->where('cnpj_cliente',HelperUtil::userInformation())->where('cnpj_loja',HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('total_nota','!=',0)->limit(10)->orderBy('data', 'desc')->get();

        return  isset($busca) > 0 ? (object) $busca : $busca;
    }

    public function formasPagamentoDiario()
    {
        $data =  date('Y-m-d');
        $busca = (object) [];
        $cnpj_loja = HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja;
        $cnpj_cliente = HelperUtil::userInformation();
        $busca = $this->db::select("
        select
        sum(meio_dinheiro) as meio_dinheiro,sum(meio_cartaodeb) as meio_cartaodeb,sum(meio_cartaocred) as meio_cartaocred,sum(meio_chequeav) as meio_chequeav,
        sum(meio_crediario)  as meio_crediario, sum(meio_chequeap) as meio_chequeap, sum(meio_outros) as meio_outros,sum(meio_chequeap) as meio_chequeap,sum(meio_chequeav) as meio_chequeav,sum(meio_crediario) as meio_crediario
        from vendas
        WHERE data BETWEEN ('{$data} 00:00:00') AND ('{$data} 23:00:00') and cnpj_loja = '{$cnpj_loja}' and cnpj_cliente = '{$cnpj_cliente}';");

        return  $busca > 0 ? $busca :  false;
    }

    public function filtros_vendas()
    {
        return [
            ['valor' =>  'cfop', 'campo' => 'CFOP','id' => 'cfop'],
            ['valor' =>  'codcliente', 'campo' => 'Codigo cliente','id' => 'codcliente'],
            ['valor' =>  'modelo_nf', 'campo' => 'Modelo de nota 65/55','id' => 'modelo_nf'],
            ['valor' =>  'codcaixa', 'campo' => 'Codigo caixa','id' => 'codcaixa'],
            ['valor' =>  'codvendedor', 'campo' => 'Codigo vendedor','id' => 'codvendedor'],
            ['valor' =>  'codigo', 'campo' => 'Codigo sistema','id' => 'codigo'],
            ['valor' =>  'codfilial', 'campo' => 'Codigo filial','id' => 'codfilial'],
            ['valor' => 'nome_vendedor','campo' =>'Nome Vendedor','id' => 'nome_vendedor']
        ];
    }

    public function filtros_vendedor()
    {

        $select = new Vendedor();
        $res = $select->all();

        return $res;
    }
}
