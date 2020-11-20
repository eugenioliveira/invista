<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * as informações do usuário atual.
     *
     * @param User $currentUser
     * @param User $userToUpdate
     * @return bool
     */
    public function edit(User $currentUser, User $userToUpdate)
    {
        /*
         * Esta política só será atingida se o usuário
         * logado não for admin. @see AuthServiceProvider@boot
         *
         * Somente usuários supervisores podem editar. E podem editar apenas usuários
         * corretores.
         */
        return $currentUser->hasRole('supervisor') && $userToUpdate->hasRole('broker');
    }
}
