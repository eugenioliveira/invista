<?php

namespace App\Http\Livewire;

use App\Actions\City\CreateNewCity;
use Livewire\Component;

class CitiesModal extends Component
{
    /**
     * Controle de estado do componente
     *
     * @var array
     */
    public $state = ['name' => '', 'state' => ''];

    /**
     * Controla a visibilidade do modal
     *
     * @var bool
     */
    public bool $showModal = false;

    /**
     * Cria uma nova cidade.
     *
     * @param CreateNewCity $creator
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createCity(CreateNewCity $creator)
    {
        $this->resetErrorBag();
        $city = $creator->create($this->state);
        $this->emit('cityAdded', $city->id);
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.cities-modal');
    }
}
