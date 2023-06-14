<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     * 'codigo',
        'produto',
        'preco_venda' ,
        'preco_custo',
        'numero' ,
        'codnota',
        'ano' ,
        'valor_total' ,
        'total_vendido' ,
        'cnpj_cliente',
        'cnpj_loja'
     */
    public function up()
    {
        Schema::create('vendas_anos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codigo');
            $table->double('valor_total');
            $table->double('total_vendido');
            $table->double('preco_custo');
            $table->double('preco_venda');
            $table->string('produto');
            $table->string('numero');
            $table->string('codnota');
            $table->string('cnpj_cliente');
            $table->string('cnpj_loja');
            $table->string('ano');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vendas_anos');
    }
};
