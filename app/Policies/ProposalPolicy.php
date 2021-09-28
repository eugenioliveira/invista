<?php

namespace App\Policies;

use App\Models\Lot;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class ProposalPolicy
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

    public function create(User $loggedUser, Lot $lotToPropose): Response
    {
        /**
         * Só é possível reservar o lote quando houver uma reserva
         * ativa efetuada pelo usuário logado
         */
        $activeReservation = $lotToPropose->activeReservation;
        if ($activeReservation instanceof Reservation) {
            if ($activeReservation->user->id !== $loggedUser->id) {
                return Response::deny('Você não pode fazer uma proposta por um lote não reservado por você.');
            }
        } else {
            return Response::deny('Para fazer uma proposta, é necessário primeiramente reservar o lote.');
        }

        return Response::allow();

    }
}
