<?php

namespace App\Http\Livewire;

use App\Models\Person;
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
    public ?string $searchTerm = null;

    /**
     * Redefine a páginação quando é realizada uma busca
     */
    public function updatingSearchTerm()
    {
        $this->resetPage();
    }


    public function render()
    {
        $peopleQuery = Person::where(function ($query) {
            $query
                ->where('first_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('last_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('cpf', 'like', '%' . $this->searchTerm . '%');
        });

        /**
         * O usuário com papel de corretor
         * só poderá gerenciar as pessoas que cadastrar.
         */
        //TODO Filtrar pessoas pelas propostas cadastradas pelo corretor atual


        return view('livewire.people-list', ['people' => $peopleQuery->paginate(10)]);
    }
}
