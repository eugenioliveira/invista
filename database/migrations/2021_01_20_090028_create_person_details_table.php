<?php

use App\Enums\CivilStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->unique()->constrained();
            $table->string('civil_status')->default(CivilStatus::SINGLE);
            $table->date('birth_date');
            $table->string('birth_location');
            $table->string('nationality');
            $table->string('rg');
            $table->string('rg_issuer');
            $table->string('occupation');
            $table->string('email');
            $table->unsignedInteger('monthly_income');
            $table->string('father_name');
            $table->string('mother_name');
            $table->foreignId('partner_id')->nullable()->references('id')->on('people');
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
        Schema::dropIfExists('person_details');
    }
}
