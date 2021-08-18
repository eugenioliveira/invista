<?php

namespace App\Actions\Reservation;

use App\Exceptions\ExistingActiveReservationException;
use App\Models\Company;
use App\Models\Lot;
use App\Models\Person;
use App\Models\User;
use Carbon\Carbon;

class CreateNewReservation
{
    /**
     *
     * Cria uma reserva no sistema.
     *
     * @param Lot $lot
     * @param User $user
     * @param Company|Person $reservable
     * @param Carbon $init
     * @param Carbon $due
     * @return \App\Models\Reservation|\Illuminate\Database\Eloquent\Model
     * @throws ExistingActiveReservationException
     */
    public function create(Lot $lot, User $user, $reservable, Carbon $init, Carbon $due)
    {
        // Verifica se já não há reserva para o lote
        if ($lot->activeReservation) {
            throw new ExistingActiveReservationException(sprintf(
                'O lote %s do loteamento %s foi reservado %s.',
                $lot->identification,
                $lot->allotment->title,
                $lot->activeReservation->init->diffForHumans()
            ));
        }

        return $reservable->reservations()->create([
            'lot_id' => $lot->id,
            'user_id' => $user->id,
            'init' => $init,
            'due' => $due
        ]);
    }
}