<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
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
     * as informações da empresa atual.
     *
     * @param User $loggedUser
     * @param Company $companyToUpdate
     */
    public function edit(User $loggedUser, Company $companyToUpdate)
    {
        /*
         * Esta política só será atingida se o usuário
         * logado não for admin. @see AuthServiceProvider@boot
         *
         * Usuários supervisores podem editar empresas cadastradas por
         * ele mesmo e por corretores. Corretores podem editar apenas
         * empresas criadas por ele mesmo.
         */

        if($loggedUser->isSupervisor()) {
            return $companyToUpdate->creator_id == $loggedUser->id || $companyToUpdate->creator->isBroker();
        }

        if ($loggedUser->isBroker()) {
            return $companyToUpdate->creator_id == $loggedUser->id;
        }
    }
}
