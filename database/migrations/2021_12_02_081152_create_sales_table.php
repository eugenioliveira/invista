<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            // Relacionamento com o Lote. Cada lote deve possuir apenas UMA venda.
            $table->foreignId('lot_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // ID da proposta
            $table->foreignId('proposal_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // ID do usuário
            $table->foreignId('user_id')
                ->constrained();

            // Cliente (Física ou Jurídica)
            $table->unsignedInteger('salable_id')->index();
            $table->string('salable_type');

            // Valor de venda do lote
            $table->unsignedDecimal('value', 13, 2);
            // Contrato de venda
            $table->string('contract')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
