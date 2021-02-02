<?php

namespace App\Http\Livewire;

use App\Actions\Person\UpdatePerson;
use App\Models\Person;
use Livewire\Component;

class EditPersonForm extends Component
{
    use RedirectHandler;

    /**
     * A pessoa que será atualizada
     *
     * @var Person
     */
    public Person $person;

    /**
     * Controle de estado do componente.
     *
     * @var array
     */
    public array $state = [];

    /**
     * Preenche o estado do componente com as informações
     * atuais da pessoa
     *
     * @param Person $person
     */
    public function mount(Person $person)
    {
        $this->person = $person;
        $this->state = $person->toArray();
    }

    /**
     * Atualiza as informações da pessoa.
     *
     * @param UpdatePerson $updater
     * @param bool $redirectAfterUpdate
     */
    public function updatePerson(UpdatePerson $updater, $redirectAfterUpdate = true)
    {
        $this->resetErrorBag();

        $updater->update($this->person, $this->state);

        // Redireciona
        $this->successAction('Pessoa salva.', ['people.index'], $redirectAfterUpdate);
    }

    public function render()
    {
        return view('livewire.edit-person-form');
    }
}
