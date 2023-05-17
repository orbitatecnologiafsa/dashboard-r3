<?php

namespace App\Models;

use App\Repositorio\Database\DatabaseRepositorio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;


    protected $fillable = [
        'codigo',
        'cnpj_loja',
        'cnpj_cliente',
        'numero' ,
        'cfop' ,
        'data' ,
        'codcliente',
        'valor_produtos',
        'total_nota' ,
        'modelo_nf' ,
        'especie' ,
        'codcaixa' ,
        'itens' ,
        'desconto' ,
        'codfilial' ,
        'data_saida' ,
        'codvendedor' ,
        'valor_recebido' ,
        'troco' ,
        'meio_dinheiro' ,
        'meio_cartaodeb' ,
        'meio_cartaocred' ,
        'meio_chequeap' ,
        'meio_chequeav' ,
        'meio_crediario' ,
        'meio_outros'
     ];
}
