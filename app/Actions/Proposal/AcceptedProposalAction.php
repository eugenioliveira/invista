<?php

namespace App\Actions\Proposal;

use App\Enums\ProposalStatusType;
use App\Models\Proposal;

class AcceptedProposalAction implements ResolveProposalAction
{
    public function resolve(Proposal $proposal, string $reason)
    {
        return $proposal->statuses()->create([
            'user_id' => \Auth::user()->id,
            'type' => ProposalStatusType::ACCEPTED,
            'reason' => $reason,
        ]);

        // TODO: Criar a Venda e Disparar e-mail avisando a mudança de status da proposta
    }
}