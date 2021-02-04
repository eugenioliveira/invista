<?php

namespace App\Http\Livewire;

use App\Actions\User\CreateNewUser;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class CreateUserForm extends Component
{
    use RedirectHandler, AuthorizesRequests;

    /**
     * Controle de estado do componente.
     *
     * @var array
     */
    public array $state = ['role' => 3];

    /**
     * Cria um novo usuário.
     *
     * @param CreateNewUser $userCreator
     * @param bool $redirectAfterCreate
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function createUser(CreateNewUser $userCreator, $redirectAfterCreate = true)
    {
        // Faz a autorização
        $this->authorize('create', [User::class, $this->state['role']]);
        // Cria um novo usuário
        $userCreator->create($this->state);
        // Redireciona
        $this->successAction('Usuário salvo.', ['users.index'], $redirectAfterCreate);
    }

    public function render()
    {
        return view('livewire.create-user-form');
    }
}
