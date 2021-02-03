<?php

namespace App\Http\Livewire;

use App\Actions\Person\SearchPerson;
use Livewire\Component;
use Livewire\WithPagination;

class PeopleList extends Component
{
    use WithPagination;

    /**
     * Termo de busca.
     *
     * @var string|null
     */
    public string $searchTerm = '';

    /**
     * Redefine a páginação quando é realizada uma busca
     */
    public function updatingSearchTerm()
    {
        $this->resetPage();
    }


    public function render(SearchPerson $searcher)
    {
        /**
         * O usuário com papel de corretor
         * só poderá gerenciar as pessoas que cadastrar.
         */
        //TODO Filtrar pessoas pelas propostas cadastradas pelo corretor atual

        $people = $searcher->search($this->searchTerm, 10);

        return view('livewire.people-list', ['people' => $people]);
    }
}
