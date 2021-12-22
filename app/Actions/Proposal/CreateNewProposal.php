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
     * @param Collection $proponents
     * @param Collection $input
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(
        Lot $lot,
        User $user,
        Collection $proponents,
        Collection $input
    ) {
        $input = $input->merge([
            'lot_id' => $lot->id,
            'user_id' => $user->id,
            'reservation_id' => $lot->activeReservation->id,
            'payment_date' => Carbon::createFromFormat('d/m/Y', $input['payment_date'])->startOfDay()
        ]);

        if ($input['installment_date']) {
            $input = $input->merge([
                'installment_date' => Carbon::createFromFormat('d/m/Y', $input['installment_date'])->startOfDay()
            ]);
        } else {
            unset($input['installment_date']);
        }

        // Retira o primeiro proponente da lista
        $firstProponent = $proponents->shift();
        // Cria a proposta para o primeiro proponente
        $proposal = $firstProponent->proposals()->create($input->toArray());
        if ($proposal instanceof Proposal) {

            // Salva os demais proponentes
            if ($proponents->isNotEmpty()) {
                $proposal->proponents()->saveMany($proponents);
            }

            $proposal->statuses()->create([
                'user_id' => $user->id,
                'type' => ProposalStatusType::UNDER_REVIEW,
                'reason' => sprintf(
                    'Proposta #%s criada em %s pelo usuário %s para o primeiro proponente %s.',
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
