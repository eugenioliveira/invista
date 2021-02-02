<?php

namespace App\Http\Livewire;

use App\Actions\Person\CreateNewPerson;
use Livewire\Component;

class CreatePersonForm extends Component
{
    use RedirectHandler;

    /**
     * Controle de estado do componente.
     *
     * @var array
     */
    public array $state = [];

    /**
     * Cria uma nova pessoa.
     *
     * @param CreateNewPerson $creator
     * @param bool $redirectAfterCreate
     */
    public function createPerson(CreateNewPerson $creator, bool $redirectAfterCreate = true)
    {
        $this->resetErrorBag();

        $creator->create($this->state);

        // Redireciona
        $this->successAction('Pessoa física salva.', ['people.index'], $redirectAfterCreate);
    }

    public function render()
    {
        return view('livewire.create-person-form');
    }
}
