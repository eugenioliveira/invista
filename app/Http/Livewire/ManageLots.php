<?php

namespace App\Http\Livewire;

use App\Actions\Lot\CreateNewLotStatus;
use App\Actions\Lot\SearchLot;
use App\Enums\LotStatusType;
use App\Models\Allotment;
use App\Models\Lot;
use App\Models\Reservation;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class ManageLots extends Component
{
    use WithPagination, WithSearch;

    /**
     * O loteamento a qual exibir os lotes.
     *
     * @var Allotment
     */
    public Allotment $allotment;

    /**
     * Flag que determina se o modal de alteração de status será exibido ou não.
     *
     * @var bool
     */
    public bool $showChangeStatusModal = false;

    /**
     * O lote selecionado para alteração de status
     *
     * @var Lot
     */
    public Lot $currentLot;

    /**
     * Controle de estado do componente
     *
     * @var array
     */
    public array $state = ['type' => LotStatusType::AVAILABLE, 'reason' => ''];

    /**
     * Inicializa o componente
     */
    public function mount()
    {
        $this->currentLot = new Lot();
    }

    /**
     * Exibe o formulário de alteração de status para o lote.
     *
     * @param Lot $lot
     */
    public function showStatusChangeForm(Lot $lot)
    {
        $this->currentLot = $lot;
        $this->toggleModal();
    }

    /**
     * Controla a exibição do modal.
     */
    public function toggleModal()
    {
        $this->resetErrorBag();
        $this->reset('state');
        $this->showChangeStatusModal = !$this->showChangeStatusModal;
    }

    /**
     * Altera o status do lote selecionado.
     *
     * @param CreateNewLotStatus $creator
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changeStatus(CreateNewLotStatus $creator)
    {
        $this->resetErrorBag();
        $status = $creator->create($this->currentLot, $this->state);
        if ($status) $this->showChangeStatusModal = false;
    }

    /**
     * Renderiza o componente.
     *
     * @param SearchLot $searcher
     * @return \Illuminate\Contracts\View\View
     */
    public function render(SearchLot $searcher)
    {
        $lots = $searcher->search($this->allotment, $this->searchTerm, 12);

        // Exibe view diferentes baseadas no papel atual do usuário.
        if (\Auth::user()->isAdmin()) {
            return view('livewire.manage-lots', [
                'lots' => $lots
            ]);
        } else {
            return view('livewire.list-lots', [
                'lots' => $lots
            ]);
        }
    }
}
