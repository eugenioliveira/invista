<?php

namespace App\Http\Livewire;

use App\Actions\Lot\CreateNewLotStatus;
use App\Enums\LotStatusType;
use App\Models\Lot;
use Livewire\Component;

class ChangeLotStatusModal extends Component
{
    /**
     * Controle de estado do componente.
     *
     * @var array
     */
    public array $state = ['type' => LotStatusType::AVAILABLE, 'reason' => ''];

    /**
     * O lote que terá seu status alterado
     *
     * @var Lot
     */
    public Lot $lot;

    /**
     * Controla a visibilidade do modal
     *
     * @var bool
     */
    public bool $showModal = false;

    /**
     * Inicialização do componente
     *
     * @param Lot $lot
     */
    public function mount(Lot $lot)
    {
        $this->lot = $lot;
    }

    public function changeStatus(CreateNewLotStatus $creator)
    {
        $this->resetErrorBag();

        $creator->create($this->lot, $this->state);

        $this->emit('lotStatusChanged');
    }

    /**
     * Renderização do componente
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        return view('livewire.change-lot-status-modal');
    }
}
