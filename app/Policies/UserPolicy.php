<?php

namespace App\Policies;

use App\Models\Role;
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
     * @param User $loggedUser
     * @param User $userToUpdate
     * @return bool
     */
    public function edit(User $loggedUser, User $userToUpdate): bool
    {
        /*
         * Esta política só será atingida se o usuário
         * logado não for admin. @see AuthServiceProvider@boot
         *
         * Somente usuários supervisores podem editar. E podem editar apenas usuários
         * corretores.
         */
        return $loggedUser->hasRole('supervisor') && $userToUpdate->hasRole('broker');
    }

    /**
     * Determina se o usuário logado pode criar um
     * novo usuário.
     *
     * @param User $loggedUser
     * @param $newUserSelectedRole
     * @return bool
     */
    public function create(User $loggedUser, $newUserSelectedRole): bool
    {
        /*
         * Esta política só será atingida se o usuário
         * logado não for admin. @see AuthServiceProvider@boot
         *
         * Somente usuários supervisores podem criar usuários. E podem criar apenas usuários
         * corretores.
         */
        return $loggedUser->hasRole('supervisor') && Role::findOrFail($newUserSelectedRole)->name == 'broker';
    }
}
