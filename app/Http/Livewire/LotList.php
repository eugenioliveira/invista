<?php

namespace App\Http\Livewire;

use App\Models\Allotment;
use Livewire\Component;
use Livewire\WithPagination;

class LotList extends Component
{
    use WithPagination;

    /**
     * O loteamento a qual exibir os lotes.
     *
     * @var Allotment|null
     */
    public ?Allotment $allotment = null;

    /**
     * Termo de busca.
     *
     * @var string|null
     */
    public ?string $searchTerm = null;

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

        return view('livewire.lot-list', [
            'lots' => $this->allotment->lots()
                ->where(function ($query) use ($block, $number) {
                    if ($block) $query->where('block', $block);
                    if ($number) $query->where('number', $number);
                })
                ->orderBy('block')
                ->orderBy('number')
                ->paginate(10)
        ]);
    }
}
