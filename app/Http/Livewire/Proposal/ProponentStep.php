<?php

namespace App\Http\Livewire\Proposal;

use App\Actions\Address\GetAddressFromApi;
use App\Enums\CivilStatus;
use App\Models\Person;
use BenSampo\Enum\Rules\EnumValue;
use Livewire\Component;

class ProponentStep extends Component
{
    public $proponents;

    public $state = [
        'cpf' => '',
        'detail' => [
            'civil_status' => '',
            'birth_date' => '',
            'rg_issue_date' => ''
        ],
        'address' => [
            'postal_code' => ''
        ]
    ];

    public $isOK = false;

    public $showProponentModal = false;
    public $showEditProponentModal = false;
    public $currentProponent = '';
    public $showPartnerModal = false;

    protected $listeners = ['reportData' => 'sendData'];

    public function rules()
    {
        return [
            'state.first_name' => ['required', 'min:3'],
            'state.last_name' => ['required', 'min:2'],
            'state.cpf' => ['required', 'numeric', 'cpf'],
            'state.phone' => ['required', 'regex:/^(\(?\d{2}\)?\s?)(\d{4,5}[\-\s]?\d{4})$/'],
            'state.detail.civil_status' => ['required', new EnumValue(CivilStatus::class, false)],
            'state.detail.birth_date' => ['required', 'date_format:d/m/Y'],
            'state.detail.birth_location' => ['required', 'min:5'],
            'state.detail.nationality' => ['required', 'min:5'],
            'state.detail.rg' => ['required', 'min:3'],
            'state.detail.rg_issuer' => ['required', 'min:3'],
            'state.detail.rg_issue_date' => ['required', 'date_format:d/m/Y'],
            'state.detail.occupation' => ['required', 'min:5'],
            'state.detail.email' => ['required', 'email:strict,dns,spoof'],
            'state.detail.monthly_income' => ['required'],
            'state.detail.father_name' => ['required', 'min:5'],
            'state.detail.mother_name' => ['required', 'min:5'],
            'state.detail.marriage_date' => ['nullable', 'sometimes', 'date_format:d/m/Y'],
            'state.detail.marriage_regime' => ['nullable', 'sometimes', 'min:5'],
            'state.address.street' => ['required', 'min:8'],
            'state.address.number' => ['required', 'numeric'],
            'state.address.apt_room' => ['nullable', 'min:3'],
            'state.address.neighbourhood' => ['required', 'min:5'],
            'state.address.city' => ['required', 'min:5'],
            'state.address.state' => ['required', 'min:2'],
            'state.address.postal_code' => ['required', 'numeric', 'digits:8']
        ];
    }

    /**
     * Faz a busca pelo CPF digitado e preenche os dados do proponente.
     *
     */
    public function findPersonByCPF()
    {
        $state = collect($this->state);
        $this->validateOnly('state.cpf', ['state.cpf' => 'required']);
        $person = Person::whereCpf($this->state['cpf'])->first();
        if ($person instanceof Person) {
            $state = $state->merge(
                collect($person)
                    ->except(['id', 'creator_id', 'created_at', 'updated_at'])
                    ->toArray()
            );

            if ($person->detail) {
                $state['detail'] = $state->merge(
                    collect($person->detail)
                        ->except(['person_id', 'partner_id', 'created_at', 'updated_at'])
                        ->toArray()
                );
            }

            if ($person->address) {
                $state['address'] = $state->merge(
                    collect($person->address)
                        ->except(['id', 'addressable_id', 'addressable_type', 'created_at', 'updated_at'])
                        ->toArray()
                );
            }
        }

        $this->state = $state->toArray();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function findAddressByCEP(GetAddressFromApi $getter)
    {
        $this->validateOnly('state.address.postal_code', ['state.address.postal_code' => 'required']);
        $address = $getter->get(['postal_code' => $this->state['address']['postal_code']]);

        if ($address) {
            $this->state['address'] = $address;
        } else {
            $this->addError('postal_code', 'O CEP informado não existe.');
        }
    }

    public function addProponent()
    {
        $this->resetErrors();
        $this->validate();
        $this->proponents[] = $this->state;
        $this->reset('state');
        $this->showProponentModal = false;
    }

    public function editProponent($index)
    {
        $this->resetErrors();
        $this->currentProponent = $index;
        $this->state = $this->proponents[$index];
        $this->showEditProponentModal = true;
    }

    public function removeProponent($index)
    {
        array_splice($this->proponents, $index, 1);
        $this->reset('state');
    }

    public function updateProponent()
    {
        $this->resetErrors();
        $this->validate();
        $this->proponents[$this->currentProponent] = $this->state;
        $this->reset('state');
        $this->showEditProponentModal = false;
    }

    public function addPartner($index)
    {
        $this->resetErrors();
        $this->reset('state');
        $this->currentProponent = $index;
        $this->showPartnerModal = true;
    }

    public function storePartner()
    {
        $this->resetErrors();
        $this->state['address'] = $this->proponents[$this->currentProponent]['address'];
        $this->validate();
        $this->proponents[$this->currentProponent]['partner'] = $this->state;
        $this->reset('state');
        $this->showPartnerModal = false;
    }

    public function removePartner($index)
    {
        $this->resetErrors();
        $this->proponents[$index]['partner'] = [];
        $this->reset('state');
    }

    public function sendData()
    {
        // Verifica se pelo menos um proponente foi cadastrado
        if (empty($this->proponents)) {
            $this->addError('general_error', 'Você precisa cadastrar pelo menos um proponente.');
            $this->isOK = false;
        }
        // Emite o evento com os dados
        if ($this->isOK) {
            $this->emitUp('proponentsData', $this->proponents);
        }
    }

    public function resetErrors()
    {
        $this->isOK = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.proposal.proponent-step');
    }
}
