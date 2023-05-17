<?php


namespace  App\Repositorio\Api;

use App\Models\Estoque;
use Exception;
use Illuminate\Support\Facades\DB;

class EstoqueApi
{

    protected $estoque;

    public function __construct()
    {
        $this->estoque = new Estoque();
    }

    public function cadastrar($estoques)
    {

        try {
            $dadosEstoque = [];
            $codigo = '';
            $cnpj_loja = '';
            $cnpj_cliente = '';
            foreach ($estoques as $estoque) {
                $codigo = $estoque['codigo'];
                $cnpj_cliente = $estoque['cnpj_cliente'];
                $cnpj_loja = $estoque['cnpj_loja'];
                $dadosEstoque = [
                    'codigo' => $estoque['codigo'],
                    'codigobarra' => $estoque['codigobarra'],
                    'produto' => $estoque['produto'],
                    'unidade' => $estoque['unidade'],
                    'codgrupo' => $estoque['codgrupo'],
                    'data_ultimacompra' => $estoque['data_ultimacompra'],
                    'notafiscal' => $estoque['notafiscal'],
                    'precocusto' => $estoque['precocusto'],
                    'precovenda' => $estoque['precovenda'],
                    'estoque' => $estoque['estoque'],
                    'unidade_atacado' => $estoque['unidade_atacado'],
                    'qtde_embalagem' => $estoque['qtde_embalagem'],
                    'tipo' => $estoque['tipo'],
                    'codfornecedor' => $estoque['codfornecedor'],
                    'cnpj_cliente' => $estoque['cnpj_cliente'],
                    'cnpj_loja' => $estoque['cnpj_loja'],
                    'created_at' => $estoque['created_at'],
                    'updated_at' =>$estoque['updated_at']
                ];
                if (Estoque::updateOrInsert(['codigo' => $codigo,'cnpj_loja' => $cnpj_loja,'cnpj_cliente'=>$cnpj_cliente],$dadosEstoque) ){
                    $insert = true;
                }
            }
            if ($insert == true) {
                return response()->json((object)["sucess" => true, "res" => "cadastrado!", "ids" => count($estoque) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            } else {
                return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar cadastrado!", "ids" => count($estoque) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            }
        } catch (Exception $e) {
            return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar!", "ids" => count($estoque) ?? '', 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }

    public function cadastrarBigData($estoque)
    {

        try {


            $insert = false;
            foreach (array_chunk($estoque, 1000) as $chunk) {
                if (Estoque::insert($chunk)) {
                    $insert = true;
                }
            }

            if ($insert == true) {
                return response()->json((object)["sucess" => true, "res" => "cadastrado!", "ids" => count($estoque) ?? ''], 200, ['Content-Type' => "application/json"]);
            } else {
                return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar cadastrado!", "ids" => count($estoque) ?? ''], 200, ['Content-Type' => "application/json"]);
            }
        } catch (Exception $e) {
            return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar!", "ids" => count($estoque) ?? '', 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }

    public function deleteBigData($cnpj_loja,$cnpj_cliente)
    {
        try {
            DB::statement('SET SQL_SAFE_UPDATES = 0;');
            DB::delete(
                "delete from estoques  where   cnpj_loja = '{$cnpj_loja}' and cnpj_cliente = '{$cnpj_cliente}'; ",
            );
            DB::statement('SET SQL_SAFE_UPDATES = 1;');
            return response()->json((object)["sucess" => true, "res" => "Deletados"], 200, ['Content-Type' => "application/json"]);

        } catch (Exception $e) {

            return response()->json((object)["sucess" => false, "res" => "Falha ao deletar!",'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);

        }
    }
}
