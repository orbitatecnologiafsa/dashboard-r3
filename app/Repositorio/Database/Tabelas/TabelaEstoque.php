<?php

namespace App\Repositorio\Database\Tabelas;



class TabelaEstoque
{

    protected $db;

    public function __construct()
    {
    }
//61 codigo 62 codnota
    public function gerarTabela()
    {
        return "
        CREATE TABLE  IF NOT EXISTS estoques(
            id bigint not null auto_increment primary key,
            created_at timestamp default current_timestamp,
            codigo varchar(100),
            codgrupo varchar(100),
            codigobarra varchar(200),
            produto varchar(200),
            data_ultimacompra timestamp default current_timestamp,
            notafiscal varchar(200),
            precocusto double,
            precovenda double,
            estoque bigint,
            unidade varchar(100),
            unidade_atacado varchar(200),
            qtde_embalagem varchar(200),
            tipo varchar(200),
            codfornecedor varchar(200)
         );
        ";
    }
}
