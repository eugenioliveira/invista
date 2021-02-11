<?php

namespace App\Http\Livewire;

use App\Actions\Person\SearchPerson;
use App\Actions\Person\UpdatePersonDetail;
use App\Enums\CivilStatus;
use App\Models\Person;
use Livewire\Component;

class PersonDetailForm extends Component
{
    use RedirectHandler;

    /**
     * A pessoa que terá seus detalhes atualizados
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
     * O cônjuge selecionado.
     *
     * @var Person|null
     */
    public ?Person $partner;

    /**
     * Event listeners
     *
     * @var string[]
     */
    protected $listeners = ['personSelected' => 'addPartner'];

    /**
     * Preenche o estado do componente.
     *
     * @param Person $person
     */
    public function mount(Person $person)
    {
        $this->person = $person;
        $this->state = $person->detail
            ? $person->detail->toArray()
            : ['civil_status' => CivilStatus::SINGLE];
        $this->partner = ($person->detail && $person->detail->partner)
            ? $person->detail->partner
            : null;
    }

    /**
     * Adiciona um cônjuge
     *
     * @param $partnerId
     */
    public function addPartner($partnerId)
    {
        $this->partner = Person::findOrFail($partnerId);
        $this->state['partner_id'] = $this->partner->id;
    }

    /**
     * Remove um cônjuge
     */
    public function removePartner()
    {
        $this->emit('personRemoved', $this->partner->id);
        $this->partner = null;
        $this->state['partner_id'] = null;
    }

    /**
     * Salva os detalhes da pessoa.
     *
     * @param UpdatePersonDetail $updater
     * @param bool $redirectAfterUpdate
     * @throws \Illuminate\Validation\ValidationException
     */
    public function saveDetail(UpdatePersonDetail $updater, $redirectAfterUpdate = true)
    {
        $this->resetErrorBag();

        $updater->update($this->person, $this->state);

        // Redireciona
        $this->successAction('Detalhes de ' . $this->person->full_name . ' salvos.', ['people.index'], $redirectAfterUpdate);
    }

    public function render()
    {
        return view('livewire.person-detail-form');
    }
}
