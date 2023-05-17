<?php


namespace App\Repositorio\Database\Inserts;

use App\Repositorio\Database\DatabaseRepositorio;
use Exception;

class CaixaInsert
{

    protected $db;



    public function __construct()
    {
        $this->db = new DatabaseRepositorio();
    }

    public function insert($caixa)
    {

        //return $this->prepareInsertSQL($caixa);
        try {
            $sql = $this->prepareInsertSQL($caixa);
            $conn = $this->conection($caixa['config']['db_instancia']);
            $conn->beginTransaction();
            $conn->query("TRUNCATE table `{$caixa['config']['db_instancia']}`.`caixas`; ");
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
            insert into caixas(codigo,codcaixa,codoperador,data,saida,entrada,codconta,historico,movimento,valor,codnfsaida,posto,codigo_venda,hora)values
        ";

        $values = '';

        foreach ($caixa['caixa'] as $dado) {

            $dado['VALOR'] = !empty($dado['VALOR']) ? ($dado['VALOR']) : 0;
            $dado['POSTO'] = !empty($dado['POSTO']) ? ($dado['POSTO']) : 0;
            $dado['ENTRADA'] = !empty($dado['ENTRADA']) ? ($dado['ENTRADA']) : 0;
            $dado['SAIDA'] = !empty($dado['SAIDA']) ? ($dado['SAIDA']) : 0;
            $dado['CODNFSAIDA'] = !empty($dado['CODNFSAIDA']) ?  $dado['CODNFSAIDA'] : 'SEM NF';
            $dado['CODIGO_VENDA'] = !empty($dado['CODIGO_VENDA']) ?  $dado['CODIGO_VENDA'] : 'SEM CODIGO';
            $dado['HISTORICO'] = !empty($dado['HISTORICO']) ? str_replace('"',"'",$dado['HISTORICO']) : "'"; //!empty($dado['HISTORICO']) ?  $dado['HISTORICO'] : 'SEM DADOS';
            $dado['MOVIMENTO'] = !empty($dado['MOVIMENTO']) ?  $dado['MOVIMENTO'] : 0;
            $dado['CODNFSAIDA'] = !empty($dado['CODNFSAIDA']) ?  $dado['CODNFSAIDA'] : 'SEM DADOS';
            $dado['POSTO'] = !empty($dado['POSTO']) ?  $dado['POSTO'] : 0;
            $dado['CODIGO_VENDA'] = !empty($dado['CODIGO_VENDA']) ?  $dado['CODIGO_VENDA'] : 0;
            $dado['HORA'] = !empty($dado['HORA']) ?  $dado['HORA'] : 0;





            $values .= "('{$dado['CODIGO']}','{$dado['CODCAIXA']}','{$dado['CODOPERADOR']}','{$dado['DATA']}',{$dado['SAIDA']},{$dado['ENTRADA']},
                         '{$dado['CODCONTA']}',".'"'.$dado['HISTORICO'].'"' .",{$dado['MOVIMENTO']},{$dado['VALOR']},'{$dado['CODNFSAIDA']}',{$dado['POSTO']},'{$dado['CODIGO_VENDA']}','{$dado['HORA']}'),";
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
