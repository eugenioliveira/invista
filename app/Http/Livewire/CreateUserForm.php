<?php

namespace App\Http\Livewire;

use App\Actions\Person\CreateNewPerson;
use App\Actions\User\CreateNewUser;
use Livewire\Component;

class CreateUserForm extends Component
{
    use RedirectHandler;

    /**
     * Controle de estado do componente.
     *
     * @var array
     */
    public array $state = [];

    /**
     * @param CreateNewPerson $personCreator
     * @param CreateNewUser $userCreator
     * @param bool $redirectAfterCreate
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createUser(CreateNewUser $userCreator, $redirectAfterCreate = true)
    {
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
