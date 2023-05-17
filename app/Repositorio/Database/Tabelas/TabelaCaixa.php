<?php

namespace App\Repositorio\Database\Tabelas;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TabelaCaixa
{
    public function __construct()
    {
    }

    public function gerarTabela()
    {
        return "
        CREATE TABLE  IF NOT EXISTS caixas(
            id bigint not null auto_increment primary key,
            created_at timestamp default current_timestamp,
            codigo varchar(10),
            codcaixa varchar(6),
            codoperador varchar(6),
            data timestamp default current_timestamp,
            saida double,
            entrada double,
            codconta varchar(6),
            historico varchar(200),
            movimento bigint,
            valor double,
            codnfsaida varchar(10) default 'SEM NF',
            posto double default 0,
            codigo_venda varchar(10) default 'SEM CODIGO',
            hora  timestamp default current_timestamp
        );
        ";
        
        // "CODIGO" character varying(10) NOT NULL,
        // "CODCAIXA" character varying(6),
        // "CODOPERADOR" character varying(6),
        // "DATA" timestamp without time zone,
        // "SAIDA" double precision,
        // "ENTRADA" double precision,
        // "CODCONTA" character varying(6),
        // "HISTORICO" character varying(200),
        // "MOVIMENTO" integer,
        // "VALOR" numeric,
        // "CODNFSAIDA" character varying(10),
        // "POSTO" integer,
        // "CODIGO_VENDA" character varying(10),
        // "HORA" timestamp without time zone DEFAULT now(),
        // CONSTRAINT "PK_C000044" PRIMARY KEY ("CODIGO")
    }
}
