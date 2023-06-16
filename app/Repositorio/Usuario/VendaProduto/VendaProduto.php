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
        $busca = $this->vendaProduto->orderBy('qtde', 'desc')->where('cnpj_cliente', HelperUtil::userInformation())->where('cnpj_loja', HelperUtil::lojaInformation('cnpj_loja')[0]->cnpj_loja)->where('total', '!=', 0)->where('cod_nota', $nota)->paginate(9);
        return  count($busca) > 0 ? $busca :  false;
    }
}
