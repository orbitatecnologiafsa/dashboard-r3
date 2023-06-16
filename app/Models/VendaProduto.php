<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaProduto extends Model
{
    use HasFactory;

    protected $table = 'venda_produtos';
    protected $fillable = [
        'produto',
        'cod_produto',
        'preco_venda',
        'preco_custo',
        'cod_nota',
        'qtde',
        'total',
        'unitario',
        'data',
        'cnpj_cliente',
        'cnpj_loja',
    ];
}
