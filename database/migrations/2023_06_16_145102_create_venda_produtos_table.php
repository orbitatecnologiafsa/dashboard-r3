<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * 'produto',
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
     * @return void
     */
    public function up()
    {
        Schema::create('venda_produtos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('produto');
            $table->string('cod_produto');
            $table->string('cod_nota');
            $table->double('qtde');
            $table->double('total');
            $table->timestamp('data')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->double('preco_venda');
            $table->double('preco_custo');
            $table->double('unitario');
            $table->string('cnpj_cliente');
            $table->string('cnpj_loja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('venda_produtos');
    }
};
