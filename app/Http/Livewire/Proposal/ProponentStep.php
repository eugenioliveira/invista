<?php

namespace App\Http\Livewire\Proposal;

use App\Actions\Address\GetAddressFromApi;
use App\Enums\CivilStatus;
use App\Models\Person;
use Livewire\Component;
use Illuminate\Support\Collection;

class ProponentStep extends Component
{
    public Collection $proponents;

    public $state = [
        'civil_status' => CivilStatus::SINGLE,
        'birth_date' => '',
        'rg_issue_date' => '',
        'address' => [
            'postal_code' => '',
        ],
        'partner' => []
    ];

    public $isOK = false;

    public $showProponentModal = false;
    public $showEditProponentModal = false;
    public $currentProponent = '';
    public $showPartnerModal = false;

    public function mount()
    {
        $this->proponents = collect([]);
    }

    /**
     * Faz a busca pelo CPF digitado e preenche os dados do proponente.
     *
     */
    public function findPersonByCPF()
    {
        $state = collect($this->state);
        $person = Person::whereCpf($this->state['cpf'])->first();
        if ($person instanceof Person) {

            $state = $state->merge(collect($person)->except([
                'id', 'creator_id', 'created_at', 'updated_at'
            ])->toArray());

            if ($person->detail) {
                $state = $state->merge(collect($person->detail)->except([
                    'person_id', 'partner_id', 'created_at', 'updated_at'
                ])->toArray());
            }
        }

        $this->state = $state->toArray();
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function findAddressByCEP(GetAddressFromApi $getter)
    {
        $address = $getter->get(['postal_code' => $this->state['address']['postal_code']]);

        if ($address) {
            $this->state['address'] = $address;
        } else {
            $this->addError('postal_code', 'O CEP informado não existe.');
        }
    }

    public function addProponent()
    {
        $this->proponents->push($this->state);
        $this->reset('state');
        $this->showProponentModal = false;
    }

    public function editProponent($index)
    {
        $this->currentProponent = $index;
        $this->state = $this->proponents[$index];
        $this->showEditProponentModal = true;
    }

    public function updateProponent()
    {
        $this->proponents[$this->currentProponent] = $this->state;
        $this->reset('state');
        $this->showEditProponentModal = false;
    }

    public function addPartner($index)
    {

    }

    public function render()
    {
        return view('livewire.proposal.proponent-step');
    }
}
