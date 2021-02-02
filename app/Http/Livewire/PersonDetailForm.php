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
     * Termo de busca por cõnjuges.
     *
     * @var string
     */
    public string $partnerSearch = '';

    /**
     * O resultado da busca de cõnjuges.
     *
     * @var mixed
     */
    public $partnerSearchResult;

    /**
     * O cônjuge selecionado.
     *
     * @var Person|null
     */
    public ?Person $partner;

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
     * Realiza uma nova busca quando digitado no campo.
     *
     * @param $searchTerm
     */
    public function updatedPartnerSearch($searchTerm)
    {
        $this->partnerSearchResult = (new SearchPerson())->search($searchTerm, $this->person->id);
    }

    /**
     * Seleciona o cônjuge.
     *
     * @param $partner
     */
    public function selectPartner($partner)
    {
        $selectedPartner = $this->partnerSearchResult->get($partner);
        $this->partner = $selectedPartner;
        $this->state['partner_id'] = $selectedPartner->id;
        $this->partnerSearch = '';
        $this->partnerSearchResult = null;
    }

    /**
     * Remove o cônjuge.
     */
    public function unselectPartner()
    {
        $this->partner = null;
        $this->state['partner_id'] = null;
        $this->partnerSearch = '';
        $this->partnerSearchResult = null;
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
