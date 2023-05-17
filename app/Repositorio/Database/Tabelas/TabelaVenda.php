<?php

namespace App\Repositorio\Database\Tabelas;


class TabelaVenda
{
    public function __construct()
    {
    }

    public function gerarTabela()
    {
        return "
        CREATE TABLE  IF NOT EXISTS vendas(
            id bigint not null auto_increment primary key,
            created_at timestamp default current_timestamp,
            codigo varchar(10),
            numero varchar(10),
            cfop varchar(10),
            data timestamp default current_timestamp,
            codcliente varchar(10),
            valor_produtos double,
            total_nota double,
            modelo_nf varchar(5),
            codcaixa varchar(100),
            itens bigint,
            desconto double,
            codfilial varchar(10),
            data_saida timestamp default current_timestamp,
            codvendedor varchar(100),
            especie varchar(10),
            valor_recebido double,
            troco double,
            meio_dinheiro double,
            meio_cartaodeb double,
            meio_cartaocred double,
            meio_chequeap double,
            meio_chequeav double,
            meio_crediario double,
            meio_outros double
         );
        ";
    }
}



