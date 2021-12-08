<?php

namespace App\Http\Livewire;

use App\Models\Allotment;
use Livewire\Component;
use Livewire\WithPagination;

class AllotmentList extends Component
{
    use WithPagination, WithSearch;

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
        $query = Allotment::query();
        if (!\Auth::user()->isAdmin()) {
            $query = \Auth::user()->allotments();
        }
        return view('livewire.allotment-list', [
            'allotments' => $query
                ->where('title', 'like', $search)
                ->withCount('lots')
                ->with('city')
                ->paginate(8)
        ]);
    }
}
