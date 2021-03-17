<?php

namespace App\Http\Livewire;

use App\Actions\Company\SearchCompany;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CompaniesList extends Component
{
    use WithPagination, WithSearch;

    /**
     * Renderiza a lista de pessoas físicas.
     *
     * @param SearchCompany $searcher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(SearchCompany $searcher)
    {
        if (Auth::user()->isAdmin()) {
            $companies = $searcher->search($this->searchTerm, 10);
        } else {
            $creators = collect(Auth::user()->id);
            /*
             * O usuário supervisor pode gerenciar as pessoas jurídicas que
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

            $companies = $searcher->search($this->searchTerm, 10, $creators->flatten()->toArray());
        }

        return view('livewire.companies-list', ['companies' => $companies]);
    }
}
