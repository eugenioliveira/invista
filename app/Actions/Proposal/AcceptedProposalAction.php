<?php

namespace App\Actions\Proposal;

use App\Actions\Sale\CreateNewSale;
use App\Enums\LotStatusType;
use App\Enums\ProposalStatusType;
use App\Models\Proposal;
use Auth;

class AcceptedProposalAction implements ResolveProposalAction
{
    public function resolve(Proposal $proposal, string $reason)
    {
        /**
         * Aplica a política de criação de venda
         */
        if (Auth::user()->cannot('createSale', [\App\Models\Sale::class, $proposal->lot])) {
            abort(403);
        }

        // Encerra a reserva
        $proposal->lot->activeReservation->finish('O lote foi vendido.');

        // Altera o status do lote para vendido
        $proposal->lot->createStatus(
            \Auth::user(),
            LotStatusType::SOLD,
            sprintf(
                'Lote vendido por meio de aceite de proposta, em %s. Vendido por %s para o cliente %s.',
                now()->format('d/m/Y H:i'),
                $proposal->user->name,
                $proposal->proposeable->full_name
            )
        );

        // Cria a venda no sistema
        (new CreateNewSale())->create($proposal);

        // Altera o status da proposta
        return $proposal->statuses()->create([
            'user_id' => \Auth::user()->id,
            'type' => ProposalStatusType::ACCEPTED,
            'reason' => $reason,
        ]);
    }
}