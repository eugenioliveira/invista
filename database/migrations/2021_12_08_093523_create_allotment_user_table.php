<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllotmentUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allotment_user', function (Blueprint $table) {
            $table->primary(['allotment_id', 'user_id']);

            // Loteamento
            $table
                ->foreignId('allotment_id')
                ->references('id')
                ->on('allotments')
                ->restrictOnDelete();

            // Usuário
            $table
                ->foreignId('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('allotment_user');
    }
}
