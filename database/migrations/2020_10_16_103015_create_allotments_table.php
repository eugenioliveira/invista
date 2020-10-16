<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllotmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allotments', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('cover')->nullable();
            $table->foreignId('city_id')->constrained();
            $table->boolean('active')->default(true);
            $table->unsignedDecimal('area', 8, 2);
            $table->decimal('latitude', 12, 9)->nullable();
            $table->decimal('longitude', 12, 9)->nullable();
            $table->unsignedDecimal('max_discount', 3, 1);
            $table->unsignedDecimal('allowable_margin', 3, 1);
            $table->unsignedInteger('reservation_duration');
            $table->unsignedInteger('assurance_parcels');
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
        Schema::dropIfExists('allotments');
    }
}
