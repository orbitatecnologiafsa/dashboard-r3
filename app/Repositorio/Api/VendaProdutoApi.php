<?php


namespace  App\Repositorio\Api;

use App\Models\VendaProduto;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;

class VendaProdutoApi
{
    protected $vendaProduto;

    public function __construct()
    {
        $this->vendaProduto = new VendaProduto();
    }

    public function cadastrar($vendaProdutos)
    {

        try {

            $dadosVendaProd = [];
            $codigo = '';
            $codigo = '';
            $cnpj_loja = '';
            $cnpj_cliente = '';
            foreach ($vendaProdutos as $vp) {
                $codigo = $vp['cod_nota'];
                $cnpj_loja = $vp['cnpj_loja'];
                $cnpj_cliente = $vp['cnpj_cliente'];
                $dadosVendaProd = [
                    'cod_nota' => $codigo,
                    'produto' => $vp['produto'],
                    'cod_produto'=> $vp['cod_produto'],
                    'preco_venda'=> $vp['preco_venda'],
                    'preco_custo'=> $vp['preco_custo'],
                    'cod_nota'=> $vp['cod_nota'],
                    'qtde'=> $vp['qtde'],
                    'total'=> $vp['total'],
                    'unitario'=> $vp['unitario'],
                    'data'=> $vp['data'],
                    'cnpj_cliente' => $vp['cnpj_cliente'],
                    'cnpj_loja' => $vp['cnpj_loja'],
                    'created_at' => $vp['created_at'],
                    'updated_at' => $vp['updated_at']
                ];
                if (VendaProduto::updateOrInsert(['cod_nota' => $codigo,'cnpj_loja' => $cnpj_loja,'cnpj_cliente'=>$cnpj_cliente],$dadosVendaProd) ){
                    $insert = true;
                }
            }

            if ($insert == true) {
                return response()->json((object)["sucess" => true, "res" => "cadastrado!", "ids" => count($vendaProdutos) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            } else {
                return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar cadastrado!", "ids" => count($vendaProdutos) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            }
        } catch (Exception $e) {
            return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar!", "ids" => count($vendaProdutos) ?? '', 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }

    public function cadastrarBigData($caixas)
    {

        try {


            $insert = false;
            foreach (array_chunk($caixas, 1000) as $chunk) {
                if (VendaProduto::insert($chunk)) {
                    $insert = true;
                }
            }

            if ($insert == true) {
                return response()->json((object)["sucess" => true, "res" => "cadastrado!", "ids" => count($caixas) ?? ''], 200, ['Content-Type' => "application/json"]);
            } else {
                return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar cadastrado!", "ids" => count($caixas) ?? ''], 200, ['Content-Type' => "application/json"]);
            }
        } catch (Exception $e) {
            return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar!", "ids" => count($caixas) ?? '', 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }

    public  function setData($data)
    {
        $date = new DateTime($data);
        return $date->format('Y-m-d H:i:s');
    }

    public  function dataArry()
    {

        $data =  date('Y');
        $intData = intval($data);
        $periodo = 1;
        $dataInit = strval($intData - $periodo);
        $dataFinal = $data;

        $array = [
            "ano_init" => $dataInit,
            "ano_final" => $dataFinal
        ];

        return $array;
    }

    public function deleteBigData($cnpj_loja, $cnpj_cliente)
    {
        try {
            DB::statement('SET SQL_SAFE_UPDATES = 0;');
            DB::delete(
                "delete from venda_produtos  where   cnpj_loja = '{$cnpj_loja}' and cnpj_cliente = '{$cnpj_cliente}'; ",
            );
            DB::statement('SET SQL_SAFE_UPDATES = 1;');
            return response()->json((object)["sucess" => true, "res" => "Deletados"], 200, ['Content-Type' => "application/json"]);
        } catch (Exception $e) {

            return response()->json((object)["sucess" => false, "res" => "Falha ao deletar!", 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }
}
