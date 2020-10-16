<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('allotment_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('block')->index();
            $table->unsignedInteger('number');
            /*
             * Define que não poderão existir dois lotes com mesmo numero
             * na mesma quadra no mesmo loteamento
             */
            $table->unique(['allotment_id', 'block', 'number']);
            $table->unsignedDecimal('price', 13, 2);
            $table->unsignedDecimal('front', 8, 2);
            $table->unsignedDecimal('back', 8, 2);
            $table->unsignedDecimal('right', 8, 2);
            $table->unsignedDecimal('left', 8, 2);
            $table->string('front_side');
            $table->string('back_side');
            $table->string('right_side');
            $table->string('left_side');
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
        Schema::dropIfExists('lots');
    }
}
