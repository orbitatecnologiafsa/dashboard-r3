<?php


namespace  App\Repositorio\Api;

use App\Models\VendaDia;
use Exception;

class VendaDiaApi
{
    public function cadastrar($vendaDia)
    {

        try {

            $dadosVendaDia = [];
            $codigo = '';
            $codigo = '';
            $cnpj_loja = '';
            $cnpj_cliente = '';
            foreach ($vendaDia as $vendaDia) {
                $codigo = $vendaDia['codigo'];
                $cnpj_loja = $vendaDia['cnpj_loja'];
                $cnpj_cliente = $vendaDia['cnpj_cliente'];
                $dadosVendaDia = [
                    'codigo' => $codigo,
                    'produto' => $vendaDia['produto'],
                    'preco_venda' => $vendaDia['preco_venda'],
                    'preco_custo' => $vendaDia['preco_custo'],
                    'numero' => $vendaDia['numero'],
                    'codnota' => $vendaDia['codnota'],
                    'ano' => $vendaDia['ano'],
                    'valor_total' => $vendaDia['valor_total'],
                    'total_vendido' => $vendaDia['total_vendido'],
                    'data' => $vendaDia['data'],
                    'total_vendido' => $vendaDia['total_vendido'],
                    'estoque' => $vendaDia['estoque'],
                    'cnpj_cliente' => $vendaDia['cnpj_cliente'],
                    'cnpj_loja' => $vendaDia['cnpj_loja'],
                    'created_at' => $vendaDia['created_at'],
                    'updated_at' => $vendaDia['updated_at']
                ];
                if (VendaDia::updateOrInsert(['codigo' => $codigo, 'cnpj_loja' => $cnpj_loja, 'cnpj_cliente' => $cnpj_cliente], $dadosVendaDia)) {
                    $insert = true;
                }
            }

            if ($insert == true) {
                return response()->json((object)["sucess" => true, "res" => "cadastrado!", "ids" => count($vendaDia) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            } else {
                return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar cadastrado!", "ids" => count($vendaDia) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            }
        } catch (Exception $e) {
            return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar!", "ids" => count($vendaDia) ?? '', 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }
}

// 'codigo',
//         'produto',
//         'preco_venda',
//         'preco_custo',
//         'numero',
//         'codnota',
//         'ano',
//         'valor_total',
//         'valor_vendido',
//         'data',
//         'total_vendido',
//         'estoque',
