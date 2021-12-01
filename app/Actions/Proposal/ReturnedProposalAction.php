<?php

namespace App\Actions\Proposal;

use App\Enums\ProposalStatusType;
use App\Mail\SendProposalResolvedEmail;
use App\Models\Proposal;
use Mail;

class ReturnedProposalAction implements ResolveProposalAction
{
    public function resolve(Proposal $proposal, string $reason)
    {
        $status = $proposal->statuses()->create([
            'user_id' => \Auth::user()->id,
            'type' => ProposalStatusType::RETURNED,
            'reason' => $reason,
        ]);

        if ($status) {
            // Quando a proposta for devolvida, a reserva atual deverá ser renovada por mais 24 horas
            $proposal->reservation->due = now()->addDay();
            $proposal->reservation->save();
        }

        return $status;
    }
}