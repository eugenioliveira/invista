<?php

namespace App\Http\Livewire;

use App\Actions\Address\GetAddressFromApi;
use App\Actions\Address\UpdatePersonAddress;
use App\Models\Person;
use Livewire\Component;

class PersonAddressForm extends Component
{
    use RedirectHandler;

    /**
     * A pessoa que terá seu endereço atualizado
     *
     * @var Person
     */
    public Person $person;

    /**
     * O estado do componente
     *
     * @var array
     */
    public array $state = [];

    /**
     * Mensagem de sucesso.
     *
     * @var string
     */
    public string $successMessage = '';

    /**
     * Preenche o estado do componente.
     *
     * @param Person $person
     */
    public function mount(Person $person)
    {
        $this->person = $person;
        $this->state = $person->address ? $person->address->toArray() : [];
    }

    /**
     * Busca um endereço pelo CEP digitado.
     *
     * @param GetAddressFromApi $getter
     */
    public function fillAddressFromPostalCode(GetAddressFromApi $getter)
    {
        $this->resetErrorBag();

        $address = $getter->get($this->state);

        if ($address) {
            $this->state = $address;
        } else {
            $this->addError('postal_code', 'O CEP informado não existe.');
        }
    }

    /**
     * Atualiza o endereço da pessoa.
     *
     * @param UpdatePersonAddress $updater
     * @param bool $redirectAfterUpdate
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateAddress(UpdatePersonAddress $updater, $redirectAfterUpdate = true)
    {
        $this->resetErrorBag();

        $updater->update($this->person, $this->state);

        // Redireciona
        $this->successAction('Endereço de ' . $this->person->full_name . ' salvo.', ['people.index'], $redirectAfterUpdate);
    }

    /**
     * Renderiza o componente.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.person-address-form');
    }
}
