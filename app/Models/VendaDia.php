<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaDia extends Model
{
    use HasFactory;

    protected $table = 'vendas_dias';
    protected $fillable = [
        'codigo',
        'produto',
        'preco_venda',
        'preco_custo',
        'numero',
        'codnota',
        'ano',
        'valor_total',
        'valor_vendido',
        'data',
        'total_vendido',
        'estoque',
        'cnpj_cliente',
        'cnpj_loja',
    ];
}
