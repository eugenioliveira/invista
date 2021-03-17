<?php

namespace App\Http\Livewire;

use App\Actions\Person\SearchPerson;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class PeopleList extends Component
{
    use WithPagination, WithSearch;

    public function render(SearchPerson $searcher)
    {
        /*
         * O usuário admin pode gerenciar todas as pessoas
         * físicas
         */
        if (Auth::user()->isAdmin()) {
            $people = $searcher->search($this->searchTerm, 10);
        } else {
            $creators = collect(Auth::user()->id);
            /*
             * O usuário supervisor pode gerenciar as pessoas físicas que
             * cadastrar e a dos corretores
             */
            if (Auth::user()->hasRole('supervisor')) {
                $creators->push(
                    Role::where('name', 'broker')
                        ->sole()
                        ->users()
                        ->pluck('id')
                );
            }

            $people = $searcher->search($this->searchTerm, 10, [], $creators->flatten()->toArray());
        }


        return view('livewire.people-list', ['people' => $people]);
    }
}
