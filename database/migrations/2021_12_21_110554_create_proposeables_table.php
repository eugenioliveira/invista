<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposeablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposeables', function (Blueprint $table) {
            // Proposta
            $table
                ->foreignId('proposal_id')
                ->references('id')
                ->on('proposals')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedInteger('proposeable_id');
            $table->string('proposeable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposeables');
    }
}
