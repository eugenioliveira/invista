<?php

namespace App\Policies;

use App\Models\Lot;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ReservationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $loggedUser, Lot $lotToReserve)
    {
        /*
         * 1. Não é possível reservar um lote com reserva ativa
         */
        if ($lotToReserve->activeReservation) {
            return Response::deny(sprintf(
                'Não é possível reservar o lote. O lote %s do loteamento %s já foi reservado %s.',
                $lotToReserve->identification,
                $lotToReserve->allotment->title,
                $lotToReserve->activeReservation->init->diffForHumans()
            ));
        }

        /**
         * 2. Um corretor não pode realizar mais do que duas reservas para o mesmo lote, caso:
         *  - A diferença de tempo entre a primeira reserva e a data atual seja inferior a 3x o tempo de
         * reserva definido nas configurações de loteamento
         */
        $dateLimit = now()->subHours($lotToReserve->allotment->reservation_duration * 3);
        $reservations = $lotToReserve
            ->reservations()
            ->whereUserId($loggedUser->id)
            ->where('init', '>', $dateLimit)
            ->orderBy('init')
            ->get();
        if ($reservations->count() >= 2) {
            return Response::deny(sprintf(
                'Você atingiu o limite de reservas para o lote %s. Você poderá reservar o lote novamente em %s',
                $lotToReserve->identification,
                $reservations
                    ->first()
                    ->init
                    ->addHours($lotToReserve->allotment->reservation_duration * 3)
                    ->format('d/m/Y à\s H:i:s')
            ));
        }

        return Response::allow();
    }
}
