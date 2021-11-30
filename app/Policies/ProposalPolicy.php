<?php

namespace App\Policies;

use App\Enums\ProposalStatusType;
use App\Models\Lot;
use App\Models\Proposal;
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
         * 1. O lote não pode possuir propostas sob análise ou devolvidas para correção
         */
        if ($lotToPropose->activeProposal instanceof Proposal) {
            return Response::deny(
                sprintf('O lote %s possui propostas sob análise ou devolvidas.', $lotToPropose->identification)
            );
        }

        /**
         * 2, Só é possível reservar o lote quando houver uma reserva
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

    public function show(User $loggedUser, Proposal $proposal)
    {
        return $proposal->user_id === $loggedUser->id;
    }

    public function resolve(User $loggedUser, Proposal $proposal)
    {
        /**
         * Só é possível alterar o status de propostas em análise ou devolvidas
         */
        if (
            $proposal->latestStatus->type->is(ProposalStatusType::ACCEPTED) ||
            $proposal->latestStatus->type->is(ProposalStatusType::DENIED)) {
            return Response::deny('Só é possível resolver propostas em análise ou devolvidas.');
        }

        return Response::allow();
    }
}
