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

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        $search = '%' . $this->searchTerm . '%';
        return view('livewire.allotment-list', [
            'allotments' => Allotment::where('title', 'like', $search)
                ->with(['lots', 'city'])
                ->paginate(8)
        ]);
    }
}
