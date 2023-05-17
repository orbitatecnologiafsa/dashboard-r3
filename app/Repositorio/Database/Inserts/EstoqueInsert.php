<?php


namespace App\Repositorio\Database\Inserts;

use App\Repositorio\Database\DatabaseRepositorio;
use Exception;

class EstoqueInsert
{

    protected $db;

    public function __construct()
    {
        $this->db = new DatabaseRepositorio();
    }

    public function insert($estoque)
    {
       //return $this->prepareInsertSQL($estoque);
        try {
            $sql = $this->prepareInsertSQL($estoque);
            $conn = $this->conection($estoque['config']['db_instancia']);
            $conn->beginTransaction();
            $conn->query("TRUNCATE table `{$estoque['config']['db_instancia']}`.`estoques`; ");
            $insert = $conn->query($sql);
            return $insert ? true : false;
            $conn->commit();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected function prepareInsertSQL($caixa)
    {
        $sql = "
            insert into estoques(codigo,codgrupo,produto,codigobarra,data_ultimacompra,notafiscal,precocusto,precovenda,estoque,unidade_atacado,qtde_embalagem,tipo,codfornecedor,unidade)values
        ";

        // $sql = 'select 
        // "CODIGO", "CODBARRA","PRODUTO","UNIDADE",
        // "CODGRUPO","DATA_ULTIMACOMPRA","NOTAFISCAL",
        // "PRECOCUSTO","PRECOVENDA","ESTOQUE","UNIDADE_ATACADO",
        // "QTDE_EMBALAGEM","TIPO","CODFORNECEDOR"
        // from 
        // "C000025";';

        $values = '';
       

        foreach ($caixa['estoque'] as $dado) {
            
            $dado['PRECOCUSTO'] = !empty($dado['PRECOCUSTO']) ? ($dado['PRECOCUSTO']) : 0;
            $dado['PRECOVENDA'] = !empty($dado['PRECOVENDA']) ? ($dado['PRECOVENDA']) : 0;
            $dado['ESTOQUE'] =  !empty($dado['ESTOQUE']) ? $dado['ESTOQUE'] : 0;
            $dado['PRODUTO'] = !empty($dado['PRODUTO']) ? str_replace('"',"'",$dado['PRODUTO']) : "'";
            $dado['UNIDADE_ATACADO'] = !empty($dado['UNIDADE_ATACADO']) ? str_replace("'","",$dado['UNIDADE_ATACADO']) : "";
            $dado['CODFORNECEDOR'] = !empty($dado['CODFORNECEDOR']) ? str_replace("'","",$dado['CODFORNECEDOR']) : "";
            $dado['DATA_ULTIMACOMPRA'] =  !empty($dado['DATA_ULTIMACOMPRA']) ? $dado['DATA_ULTIMACOMPRA'] : '';
            $dado['NOTAFISCAL'] =  !empty($dado['NOTAFISCAL']) ? $dado['NOTAFISCAL'] : '';
            $dado['CODBARRA'] =  !empty($dado['CODBARRA']) ? $dado['CODBARRA'] : '';
            $dado['TIPO'] =  !empty($dado['TIPO']) ? $dado['TIPO'] : '';
            $dado['QTDE_EMBALAGEM'] =  !empty($dado['QTDE_EMBALAGEM']) ? $dado['QTDE_EMBALAGEM'] : '';
            $dado['CODIGO'] =  !empty($dado['CODIGO']) ? $dado['CODIGO'] : '';
            $dado['CODGRUPO'] =  !empty($dado['CODGRUPO']) ? $dado['CODGRUPO'] : '';
            $dado['UNIDADE'] =  !empty($dado['UNIDADE']) ? str_replace("'","",$dado['UNIDADE']) : "";


            

            $values .= "('{$dado['CODIGO']}','{$dado['CODGRUPO']}',".'"'. $dado['PRODUTO'].'"' .",'{$dado['CODBARRA']}','{$dado['DATA_ULTIMACOMPRA']}','{$dado['NOTAFISCAL']}',{$dado['PRECOCUSTO']},{$dado['PRECOVENDA']},
                        {$dado['ESTOQUE']},'{$dado['UNIDADE_ATACADO']}','{$dado['QTDE_EMBALAGEM']}','{$dado['TIPO']}','{$dado['CODFORNECEDOR']}','{$dado['UNIDADE']}'),";
        }

        return   $sql . rtrim($values, ',') . ";";
    }

    public  function parse_money($number)
    {
        return str_replace(['R$', '.', ','], ['', '', '.'], $number);
    }

    protected function conection($db_instancia)
    {
        return  $this->db->ConnDbInstancia($db_instancia);
    }

    public  function removeMaskCpfCnpj($docuemnto)
    {
        return str_replace("/", "", str_replace('-', "", str_replace(".", "", trim($docuemnto))));
    }
}
