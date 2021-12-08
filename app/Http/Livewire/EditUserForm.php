<?php

namespace App\Http\Livewire;

use App\Actions\User\UpdateUser;
use App\Models\Allotment;
use App\Models\User;
use Illuminate\Support\Collection;
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

    public array $userAllotments;

    /**
     * Controle de estado do componente.
     *
     * @var array
     */
    public array $state = [
        'password' => '',
        'password_confirmation' => '',
        'selected_allotments' => ''
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
        $this->userAllotments = $this->user
            ->allotments()
            ->pluck('id')
            ->toArray();
        $this->state['selected_allotments'] = $this->userAllotments;
    }

    /**
     * Atualiza as informaçẽos do usuário.
     *
     * @param UpdateUser $updater
     * @param bool $redirectAfterUpdate
     */
    public function updateUser(UpdateUser $updater, $redirectAfterUpdate = true)
    {
        $this->resetErrorBag();
        // Atualiza as informações do usuário
        $updater->update($this->user, $this->state);
        // Redireciona
        $this->successAction('Usuário salvo.', ['users.index'], $redirectAfterUpdate);
    }

    /**
     * Renderiza o componente.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.edit-user-form', ['allotments' => Allotment::orderBy('title')->get()]);
    }
}
