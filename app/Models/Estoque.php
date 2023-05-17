<?php

namespace App\Models;

use App\Repositorio\Database\DatabaseRepositorio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'codfornecedor',
        'codigo',
        'codgrupo',
        'codigobarra',
        'cnpj_loja',
        'cnpj_cliente',
        'data_ultimacompra',
        'estoque',
        'notafiscal',
        'precocusto',
        'precovenda',
        'produto',
        'qtde_embalagem',
        'tipo',
        'unidade',
        'unidade_atacado'
    ];
}
