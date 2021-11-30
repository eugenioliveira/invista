<?php

namespace App\Actions\Proposal;

use App\Enums\ProposalStatusType;
use App\Models\Proposal;

class ReturnedProposalAction implements ResolveProposalAction
{
    public function resolve(Proposal $proposal, string $reason)
    {
        return $proposal->statuses()->create([
            'user_id' => \Auth::user()->id,
            'type' => ProposalStatusType::RETURNED,
            'reason' => $reason,
        ]);

        // TODO: Disparar e-mail avisando a mudança de status da proposta
    }
}