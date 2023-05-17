<?php


namespace  App\Repositorio\Api;

use App\Models\Vendedor;
use Exception;

class VendedorApi{

    protected $vendedor;

    public function __construct()
    {
        $this->vendedor = new Vendedor();
    }

    public function cadastrar($vendedores)
    {

        try {

            $dadosVendedor = [];
            $codigo = '';
            $cnpj_loja = '';
            $cnpj_cliente = '';
            foreach ($vendedores as $vendedor) {
                $codigo = $vendedor['codigo_vendedor'];
                $cnpj_loja = $vendedor['cnpj_loja'];
                $cnpj_cliente = $vendedor['cnpj_cliente'];
                $dadosVendedor = [
                    'codigo_vendedor' => $codigo,
                    'nome_vendedor' => $vendedor['nome_vendedor'],
                    'cnpj_cliente' => $vendedor['cnpj_cliente'],
                    'cnpj_loja' => $vendedor['cnpj_loja'],
                    'created_at' => $vendedor['created_at'],
                    'updated_at' => $vendedor['updated_at']

                ];
                if (Vendedor::updateOrInsert(['codigo_vendedor' => $codigo,'cnpj_loja' => $cnpj_loja,'cnpj_cliente'=>$cnpj_cliente],$dadosVendedor) ){
                    $insert = true;
                }
            }

            if ($insert == true) {
                return response()->json((object)["sucess" => true, "res" => "cadastrado!", "ids" => count($vendedores) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            } else {
                return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar cadastrado!", "ids" => count($vendedores) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            }
        } catch (Exception $e) {
            return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar!", "ids" => count($vendedores) ?? '', 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }
}
