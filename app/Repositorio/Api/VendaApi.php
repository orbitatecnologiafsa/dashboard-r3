<?php


namespace  App\Repositorio\Api;

use App\Models\Venda;
use Exception;
use Illuminate\Support\Facades\DB;


class VendaApi
{

    protected $venda;

    public function __construct()
    {
        $this->venda = new Venda();
    }

    public function cadastrar($vendas)
    {

        try {

            $dadosVendas = [];
            $codigo = '';
            $cnpj_loja = '';
            $cnpj_cliente = '';
            foreach ($vendas as $venda) {
                $codigo = $venda['codigo'];
                $cnpj_loja = $venda['cnpj_loja'];
                $cnpj_cliente = $venda['cnpj_cliente'];
                $dadosVendas = [
                    'codigo' => $venda['codigo'],
                    'numero'  => $venda['numero'],
                    'cfop'  => $venda['cfop'],
                    'data'  => $venda['data'],
                    'codcliente' => $venda['codcliente'],
                    'valor_produtos' => $venda['valor_produtos'],
                    'total_nota'  => $venda['total_nota'],
                    'modelo_nf'  => $venda['modelo_nf'],
                    'especie'  => $venda['especie'],
                    'codcaixa'  => $venda['codcaixa'],
                    'itens'  => $venda['itens'],
                    'desconto'  => $venda['desconto'],
                    'codfilial'  => $venda['codfilial'],
                    'data_saida'  => $venda['data_saida'],
                    'codvendedor'  => $venda['codvendedor'],
                    'valor_recebido'  => $venda['valor_recebido'],
                    'troco'  => $venda['troco'],
                    'meio_dinheiro'  => $venda['meio_dinheiro'],
                    'meio_cartaodeb'  => $venda['meio_cartaodeb'],
                    'meio_cartaocred'  => $venda['meio_cartaocred'],
                    'meio_chequeap'  => $venda['meio_chequeap'],
                    'meio_chequeav'  => $venda['meio_chequeav'],
                    'meio_crediario'  => $venda['meio_crediario'],
                    'meio_outros' => $venda['meio_outros'],
                    'cnpj_cliente' => $venda['cnpj_cliente'],
                    'cnpj_loja' =>  $venda['cnpj_loja'],
                    'created_at' => $venda['created_at'],
                    'updated_at' =>  $venda['updated_at']
                ];
                if (Venda::updateOrInsert(['codigo' => $codigo,'cnpj_loja' => $cnpj_loja,'cnpj_cliente'=>$cnpj_cliente],$dadosVendas) ){
                    $insert = true;
                }
            }


            if ($insert == true) {
                return response()->json((object)["sucess" => true, "res" => "cadastrado!", "ids" => count($venda) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            } else {
                return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar cadastrado!", "ids" => count($venda) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            }
        } catch (Exception $e) {
            return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar!", "ids" => count($venda) ?? '', 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }

    public function cadastrarBigData($venda)
    {
        try {


            $insert = false;
            foreach (array_chunk($venda, 1000) as $chunk) {
                if (Venda::insert($chunk)) {
                    $insert = true;
                }
            }

            if ($insert == true) {
                return response()->json((object)["sucess" => true, "res" => "cadastrado!", "ids" => count($venda) ?? ''], 200, ['Content-Type' => "application/json"]);
            } else {
                return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar cadastrado!", "ids" => count($venda) ?? ''], 200, ['Content-Type' => "application/json"]);
            }
        } catch (Exception $e) {
            return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar!", "ids" => count($venda) ?? '', 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }

    public function deleteBigData($cnpj_loja, $cnpj_cliente)
    {
        try {
            DB::statement('SET SQL_SAFE_UPDATES = 0;');
            DB::delete(
                "delete from vendas  where   cnpj_loja = '{$cnpj_loja}' and cnpj_cliente = '{$cnpj_cliente}'; ",
            );
            DB::statement('SET SQL_SAFE_UPDATES = 1;');
            return response()->json((object)["sucess" => true, "res" => "Deletados"], 200, ['Content-Type' => "application/json"]);
        } catch (Exception $e) {

            return response()->json((object)["sucess" => false, "res" => "Falha ao deletar!", 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }
}
