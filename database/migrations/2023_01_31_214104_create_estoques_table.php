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
     * @return void
     */
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('codfornecedor',200)->nullable();
            $table->string('codigo',100)->nullable();
            $table->string('codgrupo',100)->nullable();
            $table->string('codigobarra',100)->nullable();
            $table->string('cnpj_loja',100)->nullable();
            $table->string('cnpj_cliente',100)->nullable();
            $table->timestamp('data_ultimacompra')->default(DB::raw('CURRENT_TIMESTAMP'))->nullable();
            $table->integer('estoque')->nullable();
            $table->string('notafiscal')->nullable();
            $table->double('precocusto')->nullable();
            $table->double('precovenda')->nullable();
            $table->string('produto',100)->nullable();
            $table->string('qtde_embalagem',100)->nullable();
            $table->string('tipo',100)->nullable();
            $table->string('unidade',100)->nullable();
            $table->string('unidade_atacado',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estoques');
    }
};
