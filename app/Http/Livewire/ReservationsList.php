<?php

namespace App\Http\Livewire;

use App\Actions\Reservation\SearchReservations;
use Livewire\Component;
use Livewire\WithPagination;

class ReservationsList extends Component
{
    use WithPagination;

    /**
     * Termo de busca utilizado.
     *
     * @var string
     */
    public string $search = '';

    /**
     * Filtrar reservas pelo seu status.
     *
     * @var bool
     */
    public bool $active = true;

    /**
     * Coluna para ordenar
     *
     * @var string
     */
    public string $sortField = 'init';

    /**
     * A direção do ordenamento
     *
     * @var string
     */
    public string $sortDirection = 'desc';

    /**
     * ID do lote para filtragem
     *
     * @var string
     */
    public string $lot = '';

    /**
     * Ativa a queryString para facilitar o acesso aos filtros
     *
     * @var string[]
     */
    protected $queryString = ['search', 'active', 'sortField', 'sortDirection', 'lot'];

    /**
     * Controle de exibição dos filtros de data.
     *
     * @var bool
     */
    public bool $showDateFilters = false;

    /**
     * Os filtros de data a serem preenchidos
     *
     * @var array|null[]
     */
    public array $filters = [
        'init-min' => null,
        'init-max' => null,
        'due-min' => null,
        'due-max' => null
    ];

    /**
     * Redefine a páginação quando é realizada uma busca
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Redefine a filtragem por datas
     */
    public function resetFilters()
    {
        $this->reset('filters');
    }

    /**
     * Realiza a ordenação pela coluna e direção especificados.
     *
     * @param $field
     */
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    /**
     * Renderiza o componente.
     *
     * @param SearchReservations $searcher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render(SearchReservations $searcher)
    {
        $this->active = $this->lot ? false : $this->active;
        return view('livewire.reservations-list', [
            'reservations' => $searcher->search(
                $this->search,
                $this->filters,
                $this->sortField,
                $this->sortDirection,
                $this->active,
                $this->lot
            )
        ]);
    }
}
