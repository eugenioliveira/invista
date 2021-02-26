<?php

namespace App\Http\Livewire;

use App\Actions\Lot\CreateNewLotStatus;
use App\Enums\LotStatusType;
use App\Models\Allotment;
use App\Models\Lot;
use Livewire\Component;
use Livewire\WithPagination;

class ManageLots extends Component
{
    use WithPagination;

    /**
     * O loteamento a qual exibir os lotes.
     *
     * @var Allotment
     */
    public Allotment $allotment;

    /**
     * Termo de busca.
     *
     * @var string|null
     */
    public ?string $searchTerm = null;

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
        $this->showChangeStatusModal = true;
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
     * Redefine a páginação quando é realizada uma busca
     */
    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    /**
     * Renderiza o componente.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        // Retorna o bloco do campo de pesquisa
        preg_match('/[A-Za-z]+/', $this->searchTerm, $block);
        // Retorna o número do campo de pesquisa
        preg_match('/\d+/', $this->searchTerm, $number);

        // Busca os lotes
        $lots = $this->allotment->lots()
            ->where(function ($query) use ($block, $number) {
                if ($block) $query->where('block', $block);
                if ($number) $query->where('number', $number);
            })
            ->orderBy('block')
            ->orderBy('number')
            ->paginate(10);

        // Exibe view diferentes baseadas no papel atual do usuário.
        if (\Auth::user()->isAdmin()) {
            return view('livewire.manage-lots', [
                'lots' => $lots
            ]);
        } else {
            // Retornar outra view com menos opções.
        }
    }
}
