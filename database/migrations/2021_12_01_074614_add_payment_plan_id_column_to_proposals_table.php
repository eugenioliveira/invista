<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentPlanIdColumnToProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table
                ->foreignId('payment_plan_id')
                ->after('proposeable_type')
                ->nullable()
                ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proposals', function (Blueprint $table) {
            $table->dropForeign(['payment_plan_id']);
        });
    }
}
