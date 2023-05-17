<?php


namespace App\Repositorio\Database\Inserts;

use App\Repositorio\Database\DatabaseRepositorio;
use Exception;

class VendaInsert
{

    protected $db;

    public function __construct()
    {
        $this->db = new DatabaseRepositorio();
    }

    public function insert($vendas)
    {

        try {

            $sql = $this->prepareInsertSQL($vendas);
            $conn = $this->conection($vendas['config']['db_instancia']);
            $conn->beginTransaction();
            $conn->query("TRUNCATE table `{$vendas['config']['db_instancia']}`.`vendas`; ");
            $insert = $conn->query($sql);
            return $insert ? true : false;
            $conn->commit();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected function prepareInsertSQL($vendas)
    {
        $sql = "
        insert into vendas(codigo,
        numero ,
        cfop ,
        data ,
        codcliente,
        valor_produtos,
        total_nota ,
        modelo_nf ,
        especie ,
        codcaixa ,
        itens ,
        desconto ,
        codfilial ,
        data_saida ,
        codvendedor ,
        valor_recebido ,
        troco ,
        meio_dinheiro ,
        meio_cartaodeb ,
        meio_cartaocred ,
        meio_chequeap ,
        meio_chequeav ,
        meio_crediario ,
        meio_outros)values
        ";

        $values = '';

        foreach ($vendas['venda'] as $dado) {

            $dado['CODIGO'] = empty($dado['CODIGO']) ? 'SEM CODIGO' : $dado['CODIGO'];
            $dado['MODELO_NF'] = empty($dado['MODELO_NF']) ? 'SEM MODELO' : $dado['MODELO_NF'];
            $dado['NUMERO'] = empty($dado['NUMERO']) ? 'SEM NUMERO' : $dado['NUMERO'];
            $dado['CFOP'] = empty($dado['CFOP']) ? 'SEM CFOP' : $dado['CFOP'];
            $dado['CODCLIENTE'] = empty($dado['CODCLIENTE']) ? 'SEM CODIGO' : $dado['CODCLIENTE'];
            $dado['CODVENDEDOR'] = empty($dado['CODVENDEDOR']) ? 'SEM CODIGO' : $dado['CODVENDEDOR'];
            $dado['CODFILIAL'] = empty($dado['CODFILIAL']) ? 'SEM CODIGO' : $dado['CODFILIAL'];
            $dado['MODELO'] = empty($dado['MODELO']) ? 'SEM MODELO' : $dado['MODELO'];
            $dado['ESPECIE'] = empty($dado['ESPECIE']) ? 'SEM ESPECIE' : $dado['ESPECIE'];
            $dado['CODCAIXA'] = empty($dado['CODCAIXA']) ? 'SEM CAIXA' : $dado['CODCAIXA'];
            $dado['ITENS'] = empty($dado['ITENS']) ? 0 : $dado['ITENS'];
            $dado['DESCONTO'] = empty($dado['DESCONTO']) ? 0 : ($dado['DESCONTO']);
            $dado['MEIO_DINHEIRO'] = empty($dado['MEIO_DINHEIRO']) ? 0 : $dado['MEIO_DINHEIRO'];
            $dado['MEIO_CREDIARIO'] = empty($dado['MEIO_CREDIARIO']) ? 0 : ($dado['MEIO_CREDIARIO']);
            $dado['MEIO_CARTAOCRED'] = empty($dado['MEIO_CARTAOCRED']) ? 0 : ($dado['MEIO_CARTAOCRED']);
            $dado['MEIO_CARTAODEB'] = empty($dado['MEIO_CARTAODEB']) ? 0 : ($dado['MEIO_CARTAODEB']);
            $dado['MEIO_OUTROS'] = empty($dado['MEIO_OUTROS']) ? 0 : ($dado['MEIO_OUTROS']);
            $dado['MEIO_CHEQUEAP'] = empty($dado['MEIO_CHEQUEAP']) ? 0 : ($dado['MEIO_CHEQUEAP']);
            $dado['MEIO_CHEQUEAV'] = empty($dado['MEIO_CHEQUEAV']) ? 0 : ($dado['MEIO_CHEQUEAV']);
            $dado['TROCO'] = empty($dado['TROCO']) ? 0 : ($dado['TROCO']);
            $dado['VALOR_RECEBIDO'] = empty($dado['VALOR_RECEBIDO']) ? 0 : ($dado['VALOR_RECEBIDO']);
            $dado['VALOR_PRODUTOS'] = empty($dado['VALOR_PRODUTOS']) ? 0 : ($dado['VALOR_PRODUTOS']);
            $dado['TOTAL_NOTA'] = empty($dado['TOTAL_NOTA']) ? 0 : ($dado['TOTAL_NOTA']);

            $values .= "('{$dado['CODIGO']}','{$dado['NUMERO']}','{$dado['CFOP']}','{$dado['DATA']}',
            '{$dado['CODCLIENTE']}',{$dado['VALOR_PRODUTOS']},{$dado['TOTAL_NOTA']},'{$dado['MODELO_NF']}',
            '{$dado['ESPECIE']}','{$dado['CODCAIXA']}',{$dado['ITENS']},{$dado['DESCONTO']},'{$dado['CODFILIAL']}',
            '{$dado['DATA_SAIDA']}','{$dado['CODVENDEDOR']}',{$dado['VALOR_RECEBIDO']},{$dado['TROCO']},
            {$dado['MEIO_DINHEIRO']},{$dado['MEIO_CARTAODEB']},{$dado['MEIO_CARTAOCRED']},{$dado['MEIO_CHEQUEAP']},
            {$dado['MEIO_CHEQUEAV']}, {$dado['MEIO_CREDIARIO']},{$dado['MEIO_OUTROS']}),";
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
