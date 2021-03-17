<?php

use App\Enums\LotStatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot_statuses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('lot_id')
                ->references('id')
                ->on('lots')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->unsignedTinyInteger('type')->default(LotStatusType::AVAILABLE)->index();
            $table->text('reason');
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
        Schema::dropIfExists('lot_statuses');
    }
}
