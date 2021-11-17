<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();

            // Relacionamento com o Lote
            $table
                ->foreignId('lot_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Relacionamento com o corretor
            $table
                ->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Relacionamento com a reserva
            $table
                ->foreignId('reservation_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Relacionamento com o Cliente (Física ou Jurídica)
            $table->unsignedInteger('proposeable_id')->index();
            $table->string('proposeable_type');

            // O tipo da proposta (À vista / Parcelada)
            $table->unsignedInteger('type');
            // Valor negociado (O valor que o cliente irá pagar)
            $table->unsignedDecimal('negotiated_value', 13, 2);
            // Valor de entrada (Caso haja)
            $table->unsignedDecimal('down_payment', 13, 2);
            // Número de parcelas
            $table->unsignedInteger('installments');
            // Valor da parcela
            $table->unsignedDecimal('installment_value', 13, 2);
            // Observações
            $table->text('comments')->nullable();

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
        Schema::dropIfExists('proposals');
    }
}
