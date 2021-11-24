<?php

namespace App\Policies;

use App\Models\Lot;
use App\Models\Proposal;
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
        /**
         * 1. Não é possível reservar um lote que não está com o status disponível
         */
        if (!$lotToReserve->isAvailable()) {
            return Response::deny(
                sprintf('O lote %s não está disponível para reserva.', $lotToReserve->identification)
            );
        }

        /*
         * 2. Não é possível reservar um lote com reserva ativa
         */
        if ($lotToReserve->activeReservation) {
            return Response::deny(
                sprintf(
                    'Não é possível reservar o lote. O lote %s do loteamento %s já foi reservado %s.',
                    $lotToReserve->identification,
                    $lotToReserve->allotment->title,
                    $lotToReserve->activeReservation->init->diffForHumans()
                )
            );
        }

        /**
         * 3. Um corretor não pode realizar mais do que duas reservas para o mesmo lote, caso:
         *  — A diferença de tempo entre a primeira reserva e a data atual seja inferior a 3x o tempo de
         * reserva definido nas configurações de loteamento
         */
        $dateLimit = now()->subHours($lotToReserve->allotment->reservation_duration * 3);
        $reservations = $lotToReserve
            ->reservations()
            ->where('user_id', $loggedUser->id)
            ->where('init', '>', $dateLimit)
            ->orderBy('init')
            ->get();
        if ($reservations->count() >= 2) {
            return Response::deny(
                sprintf(
                    'Você atingiu o limite de reservas para o lote %s. Você poderá reservar o lote novamente em %s',
                    $lotToReserve->identification,
                    $reservations
                        ->first()
                        ->init->addHours($lotToReserve->allotment->reservation_duration * 3)
                        ->format('d/m/Y à\s H:i:s')
                )
            );
        }

        /**
         * 4 - Não é possível reservar um lote com proposta ativa
         */
        if ($lotToReserve->activeProposal instanceof Proposal) {
            return Response::deny(
                sprintf(
                    'O lote %s não pode ser reservado pois possui uma proposta sob análise ou devolvida.',
                    $lotToReserve->identification
                )
            );
        }

        return Response::allow();
    }

    /**
     * O usuário só pode cancelar uma reserva feita por ele mesmo.
     *
     * @param User $loggedUser
     * @param Lot $lot
     * @return bool
     */
    public function cancel(User $loggedUser, Lot $lot): bool
    {
        return $lot->activeReservation && $lot->activeReservation->user_id == $loggedUser->id;
    }
}
