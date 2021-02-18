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
     * @return bool
     */
    public function edit(User $loggedUser, Company $companyToUpdate): bool
    {
        /*
         * Esta política só será atingida se o usuário
         * logado não for admin. @see AuthServiceProvider@boot
         *
         * Usuários supervisores podem editar empresas cadastradas por
         * ele mesmo e por corretores. Corretores podem editar apenas
         * empresas criadas por ele mesmo.
         */

        if($loggedUser->hasRole('supervisor')) {
            return $companyToUpdate->creator_id == $loggedUser->id || $companyToUpdate->creator->hasRole('broker');
        }

        if ($loggedUser->hasRole('broker')) {
            return $companyToUpdate->creator_id == $loggedUser->id;
        }
    }
}
