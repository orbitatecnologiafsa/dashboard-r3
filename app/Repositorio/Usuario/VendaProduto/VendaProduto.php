<?php



namespace App\Repositorio\Usuario\VendaProduto;

use App\Models\VendaProduto as ModelsVendaProduto;
use App\Repositorio\Util\HelperUtil;

class VendaProduto
{
    protected $vendaProduto;


    public function __construct()
    {
        $this->vendaProduto = new ModelsVendaProduto();
    }

    public function getListaProdutoByCodNota($nota)
    {
        $busca = [];
        $res = [];
        $busca = $this->vendaProduto->where('cod_nota', $nota)->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->orderBy('qtde', 'desc')->paginate(9);
        $total = $this->vendaProduto->where('cod_nota', $nota)->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->sum('total');

        $res = [
            'busca' => $busca,
            'total' => $total
        ];
        return  count($busca) > 0 ? $res :  ['busca' => [],'total'  => 0];
    }
}
