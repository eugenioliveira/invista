<?php

namespace App\Http\Livewire;

use App\Actions\Address\GetAddressFromApi;
use App\Actions\Address\UpdateAddress;
use App\Models\Company;
use App\Models\Person;
use Livewire\Component;

class AddressForm extends Component
{
    use RedirectHandler;

    /**
     * A pessoa ou empresa que terá seu endereço atualizado
     *
     * @var Person|Company
     */
    public $adressable;

    /**
     * O estado do componente
     *
     * @var array
     */
    public array $state = [];

    /**
     * Flag que determina se os campos devem ser
     * desabilitados ou não
     *
     * @var bool
     */
    public bool $blockFields = true;

    /**
     * Preenche o estado do componente.
     *
     * @param Person|Company $adressable
     */
    public function mount($adressable)
    {
        $this->adressable = $adressable;
        $this->state = $adressable->address ? $adressable->address->toArray() : [];
    }

    /**
     * Busca um endereço pelo CEP digitado.
     *
     * @param GetAddressFromApi $getter
     * @throws \Illuminate\Validation\ValidationException
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

        $this->blockFields = false;
    }

    /**
     * Atualiza o endereço da pessoa.
     *
     * @param UpdateAddress $updater
     * @param bool $redirectAfterUpdate
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateAddress(UpdateAddress $updater, $redirectAfterUpdate = true)
    {
        $this->resetErrorBag();

        $updater->update($this->adressable, $this->state);

        // Redireciona
        if ($this->adressable instanceof Person) {
            $adressableName = $this->adressable->full_name;
            $adressableRoute = 'people.index';
        } else {
            $adressableName = $this->adressable->name;
            $adressableRoute = 'companies.index';
        }
        $this->successAction('Endereço de ' . $adressableName . ' salvo.', [$adressableRoute], $redirectAfterUpdate);
    }

    /**
     * Renderiza o componente.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.address-form');
    }
}
