<?php

namespace App\Http\Livewire;

use App\Actions\Person\SearchPerson;
use Illuminate\Support\Collection;
use Livewire\Component;

class SearchPersonDropdown extends Component
{
    /**
     * Termo de busca
     *
     * @var string
     */
    public string $search = '';

    /**
     * Resultados da busca
     *
     * @var mixed
     */
    public $searchResults = [];

    /**
     * Exclusões
     *
     * @var Collection
     */
    public Collection $exclude;

    /**
     * Event listeners
     *
     * @var string[]
     */
    protected $listeners = ['personRemoved' => 'updateExclude'];

    /**
     * Remove o id passado da lista de exclusões
     *
     * @param $id
     */
    public function updateExclude($id)
    {
        $this->exclude->forget($this->exclude->search($id));
    }

    /**
     * Emite um evento com a pessoa selecionada
     *
     * @param $key
     */
    public function selectPerson($key)
    {
        $this->exclude->push($this->searchResults->get($key)->id);
        $this->emit('personSelected', $this->searchResults->get($key)->id);
        $this->reset('search', 'searchResults');
    }

    /**
     * Renderiza o componente
     *
     * @param SearchPerson $searcher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(SearchPerson $searcher)
    {
        if (strlen($this->search) >= 2) {
            $this->searchResults = $searcher->search($this->search, false, $this->exclude->toArray());
        }

        return view('livewire.search-person-dropdown');
    }
}
