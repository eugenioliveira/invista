<?php

namespace App\Actions\Proposal;

use App\Enums\ProposalStatusType;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Support\Collection;

class UpdateProposal
{
    public function update(Proposal $proposal, User $user, Collection $input)
    {
        if ($proposal->update($input->toArray())) {
            $proposal->statuses()->create([
                'user_id' => $user->id,
                'type' => ProposalStatusType::UNDER_REVIEW,
                'reason' => sprintf(
                    'Proposta #%s alterada em %s pelo usuário %s para o cliente %s.',
                    $proposal->id,
                    $proposal->updated_at->format('d/m/Y H:i'),
                    $proposal->user->name,
                    $proposal->proposeable->full_name
                )
            ]);

            return $proposal;
        }
    }
}