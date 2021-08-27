<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllotmentPaymentPlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allotment_payment_plan', function (Blueprint $table) {
            $table->primary(['allotment_id', 'payment_plan_id']);

            // Loteamento
            $table->foreignId('allotment_id')
                ->references('id')
                ->on('allotments')
                ->restrictOnDelete();

            // Plano de pagamento
            $table->foreignId('payment_plan_id')
                ->references('id')
                ->on('payment_plans')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('allotment_payment_plan');
    }
}
