<?php


namespace  App\Repositorio\Api;

use App\Models\VendaAno;
use Exception;

class VendaAnoApi
{
    protected $vendaAno;

    public function __construct()
    {
        $vendaAno = new VendaAno();
    }
    public function cadastrar($vendasAno)
    {

        try {

            $dadosVendaAno = [];
            $codigo = '';
            $codigo = '';
            $cnpj_loja = '';
            $cnpj_cliente = '';
            foreach ($vendasAno as $vendaAno) {
                $codigo = $vendaAno['codigo'];
                $cnpj_loja = $vendaAno['cnpj_loja'];
                $cnpj_cliente = $vendaAno['cnpj_cliente'];
                $dadosVendaAno = [
                    'codigo' => $codigo,
                    'cnpj_cliente' => $vendaAno['cnpj_cliente'],
                    'produto'=> $vendaAno['produto'],
                    'preco_venda'=> $vendaAno['preco_venda'],
                    'preco_custo'=> $vendaAno['preco_custo'],
                    'numero'=> $vendaAno['numero'],
                    'codnota'=> $vendaAno['codnota'],
                    'ano'=> $vendaAno['ano'],
                    'valor_total'=> $vendaAno['valor_total'],
                    'total_vendido'=> $vendaAno['total_vendido'],
                    'cnpj_cliente' => $vendaAno['cnpj_cliente'],
                    'cnpj_loja' => $vendaAno['cnpj_loja'],
                    'created_at' => $vendaAno['created_at'],
                    'updated_at' => $vendaAno['updated_at']
                ];
                if (VendaAno::updateOrInsert(['codigo' => $codigo, 'cnpj_loja' => $cnpj_loja, 'cnpj_cliente' => $cnpj_cliente], $dadosVendaAno)) {
                    $insert = true;
                }
            }

            if ($insert == true) {
                return response()->json((object)["sucess" => true, "res" => "cadastrado!", "ids" => count($vendasAno) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            } else {
                return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar cadastrado!", "ids" => count($vendasAno) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            }
        } catch (Exception $e) {
            return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar!", "ids" => count($vendasAno) ?? '', 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }
}
