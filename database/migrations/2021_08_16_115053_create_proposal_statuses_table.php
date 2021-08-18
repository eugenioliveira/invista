<?php

use App\Enums\ProposalStatusType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposal_statuses', function (Blueprint $table) {
            $table->id();

            // Relacionamento com a Proposta
            $table->foreignId('proposal_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Relacionamento com o usuário (Para registro de quem alterou o estado)
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');

            // Tipo do Status da proposta
            $table->unsignedTinyInteger('type')->default(ProposalStatusType::UNDER_REVIEW)->index();

            // Motivo da mudança de status
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
        Schema::dropIfExists('proposal_statuses');
    }
}
