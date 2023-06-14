<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaAno extends Model
{
    use HasFactory;
    protected $table = 'vendas_anos';
    protected $fillable = [
        'codigo',
        'produto',
        'preco_venda' ,
        'preco_custo',
        'numero' ,
        'codnota',
        'ano',
        'data',
        'valor_total' ,
        'total_vendido',
        'cnpj_cliente',
        'cnpj_loja'
    ];

}
