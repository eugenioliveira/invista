<?php

namespace App\Actions\Proposal;

use App\Enums\ProposalStatusType;
use App\Models\Company;
use App\Models\Lot;
use App\Models\Person;
use App\Models\Proposal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class CreateNewProposal
{
    /**
     * @param Lot $lot
     * @param User $user
     * @param Company|Person $proposeable
     * @param Collection $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(
        Lot $lot,
        User $user,
        $proposeable,
        Collection $input
    ) {
        $input = $input->merge([
            'lot_id' => $lot->id,
            'user_id' => $user->id,
            'reservation_id' => $lot->activeReservation->id,
            'payment_date' => Carbon::createFromFormat('d/m/Y', $input['payment_date'])->startOfDay()
        ]);

        $proposal = $proposeable->proposals()->create($input->toArray());

        if ($proposal instanceof Proposal) {
            $proposal->statuses()->create([
                'user_id' => $user->id,
                'type' => ProposalStatusType::UNDER_REVIEW,
                'reason' => sprintf(
                    'Proposta #%s criada em %s pelo usuário %s para o cliente %s.',
                    $proposal->id,
                    $proposal->created_at->format('d/m/Y H:i'),
                    $proposal->user->name,
                    $proposal->proposeable->full_name
                )
            ]);
        }

        return $proposal;
    }
}
