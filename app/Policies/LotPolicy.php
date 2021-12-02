<?php

namespace App\Policies;

use App\Models\Lot;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LotPolicy
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

    /**
     * Determina se o lote pode ter seu status alterado.
     *
     * @param User $loggedUser
     * @param Lot $lot
     */
    public function changeLotStatus(User $loggedUser, Lot $lot)
    {
        /**
         * 1. O lote não pode possuir uma venda
         */
        if ($lot->sale instanceof Sale) {
            return Response::deny(
                sprintf(
                    'O lote %s possui uma venda, portanto, não pode ter seu status alterado.',
                    $lot->identification
                )
            );
        }

        return Response::allow();
    }
}
