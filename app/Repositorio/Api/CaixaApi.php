<?php


namespace  App\Repositorio\Api;

use App\Models\Caixa;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;


class CaixaApi
{

    protected $caixa;

    public function __construct()
    {
        $this->caixa = new Caixa();
    }

    public function cadastrar($caixas)
    {

        try {

            $dadosCaixa = [];
            $codigo = '';
            $codigo = '';
            $cnpj_loja = '';
            $cnpj_cliente = '';
            foreach ($caixas as $caixa) {
                $codigo = $caixa['codigo'];
                $cnpj_loja = $caixa['cnpj_loja'];
                $cnpj_cliente = $caixa['cnpj_cliente'];
                $dadosCaixa = [
                    'codigo' => $codigo,
                    'codcaixa' => $caixa['codcaixa'],
                    'codoperador' => $caixa['codoperador'],
                    'data' => $caixa['data'],
                    'saida' => $caixa['saida'],
                    'entrada' => $caixa['entrada'],
                    'codconta' => $caixa['codconta'],
                    'historico' => $caixa['historico'],
                    'movimento' => $caixa['movimento'],
                    'valor' => $caixa['valor'],
                    'codnfsaida' => $caixa['codnfsaida'],
                    'posto' => $caixa['posto'],
                    'codigo_venda' => $caixa['codigo_venda'],
                    'hora' => $caixa['data'],
                    'cnpj_cliente' => $caixa['cnpj_cliente'],
                    'cnpj_loja' => $caixa['cnpj_loja'],
                    'created_at' => $caixa['created_at'],
                    'updated_at' => $caixa['updated_at']
                ];
                if (Caixa::updateOrInsert(['codigo' => $codigo,'cnpj_loja' => $cnpj_loja,'cnpj_cliente'=>$cnpj_cliente],$dadosCaixa) ){
                    $insert = true;
                }
            }

            if ($insert == true) {
                return response()->json((object)["sucess" => true, "res" => "cadastrado!", "ids" => count($caixas) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            } else {
                return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar cadastrado!", "ids" => count($caixas) ?? '', "deletes" => ''], 200, ['Content-Type' => "application/json"]);
            }
        } catch (Exception $e) {
            return response()->json((object)["sucess" => false, "res" => "Falha ao cadastrar!", "ids" => count($caixas) ?? '', 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }

    public function cadastrarBigData($caixas)
    {

        try {


            $insert = false;
            foreach (array_chunk($caixas, 1000) as $chunk) {
                if (Caixa::insert($chunk)) {
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
                "delete from caixas  where   cnpj_loja = '{$cnpj_loja}' and cnpj_cliente = '{$cnpj_cliente}'; ",
            );
            DB::statement('SET SQL_SAFE_UPDATES = 1;');
            return response()->json((object)["sucess" => true, "res" => "Deletados"], 200, ['Content-Type' => "application/json"]);
        } catch (Exception $e) {

            return response()->json((object)["sucess" => false, "res" => "Falha ao deletar!", 'exception' => $e->getMessage()], 200, ['Content-Type' => "application/json"]);
        }
    }
}
