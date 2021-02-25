<?php

namespace App\Http\Livewire;

use App\Models\Allotment;
use Livewire\Component;
use Livewire\WithPagination;

class AllotmentList extends Component
{
    use WithPagination;

    /**
     * O termo de busca para o loteamento.
     *
     * @var string|null
     */
    public ?string $searchTerm = null;

    /**
     * O loteamento selecionado para exibir as opções
     *
     * @var Allotment
     */
    public Allotment $currentAllotment;

    /**
     * Flag que determina se o painel de opções deverá ser exibido
     *
     * @var bool
     */
    public bool $showOptionsPanel = false;

    /**
     * Redefine a páginação quando é realizada uma busca
     */
    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    /**
     * Inicializa o componente
     */
    public function mount()
    {
        $this->currentAllotment = new Allotment();
    }

    /**
     * Mostra o painel de opções para o loteamento $allotment.
     *
     * @param Allotment $allotment
     */
    public function showOptions(Allotment $allotment)
    {
        $this->currentAllotment = $allotment;
        $this->showOptionsPanel = true;
    }

    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        return view('livewire.allotment-list', [
            'allotments' => Allotment::where('title', 'like', $search)
                ->withCount('lots')
                ->with('city')
                ->paginate(8)
        ]);
    }
}
