<?php

namespace App\Http\Livewire;

use App\Actions\User\UpdateUser;
use App\Models\User;
use Livewire\Component;

class EditUserForm extends Component
{
    use RedirectHandler;

    /**
     * O usuário que será atualizado
     *
     * @var User
     */
    public User $user;

    /**
     * Controle de estado do componente.
     *
     * @var array
     */
    public array $state = [
        'password' => '',
        'password_confirmation' => ''
    ];

    /**
     * Preenche o estado do componente
     *
     * @param User $user
     */
    public function mount(User $user)
    {
        $this->user = $user;
        $this->state['email'] = $user->email;
        $this->state['role'] = $user->roles()->first()->id;
    }

    public function updateUser(UpdateUser $updater, $redirectAfterUpdate = true)
    {
        $this->resetErrorBag();
        // Atualiza as informações do usuário
        $updater->update($this->user, $this->state);
        // Redireciona
        $this->successAction('Usuário salvo.', ['users.index'], $redirectAfterUpdate);
    }

    public function render()
    {
        return view('livewire.edit-user-form');
    }
}
