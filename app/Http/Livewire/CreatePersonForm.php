<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\Person;
use App\Models\PersonDetail;
use Livewire\Component;

class CreatePersonForm extends Component
{
    use RedirectHandler, ExternalAddressApi, PersonFormDefinition;

    /**
     * Event listeners
     *
     * @var string[]
     */
    protected $listeners = ['partnerRegistered' => 'associateRegisteredPartner'];

    /**
     * Monta o componente.
     *
     * @param Person $person
     * @param Address $address
     */
    public function mount(Person $person)
    {
        // Atribui a pessoa atual
        $this->person = $person;
        // Atribui o cônjuge da pessoa atual
        $this->partner = new Person();
        // Atribui os detalhes da pessoa atual
        $this->detail = new PersonDetail();
        // Atribui o endereço da pessoa atual
        $this->address = new Address();
    }

    /**
     * Relaciona o cônjuge quando o cadastro for realizado no mesmo
     * formulário.
     *
     * @param Person $partner
     */
    public function associateRegisteredPartner(Person $partner)
    {
        $this->partner = $partner;
    }

    /**
     * Renderiza o componente.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.person-form');
    }
}
