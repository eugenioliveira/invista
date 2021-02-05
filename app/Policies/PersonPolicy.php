<?php

namespace App\Policies;

use App\Models\Person;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Database\Eloquent\Builder;

class PersonPolicy
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
     * Determina se o usuário logado pode editar
     * as informações da pessoa atual.
     *
     * @param User $loggedUser
     * @param Person $personToUpdate
     * @return bool
     */
    public function edit(User $loggedUser, Person $personToUpdate): bool
    {
        /*
         * Esta política só será atingida se o usuário
         * logado não for admin. @see AuthServiceProvider@boot
         *
         * Usuários supervisores podem editar pessoas cadastradas por
         * ele mesmo e por corretores. Corretores podem editar apenas
         * pessoas criadas por ele mesmo.
         */

        if($loggedUser->hasRole('supervisor')) {
            return $personToUpdate->creator_id == $loggedUser->id || $personToUpdate->creator->hasRole('broker');
        }

        if ($loggedUser->hasRole('broker')) {
            return $personToUpdate->creator_id == $loggedUser->id;
        }
    }
}
