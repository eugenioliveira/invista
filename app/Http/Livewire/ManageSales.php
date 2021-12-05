<?php

namespace App\Http\Livewire;

use App\Actions\Sale\SearchSales;
use Livewire\Component;
use Livewire\WithPagination;

class ManageSales extends Component
{
    use WithPagination, RedirectHandler;

    /**
     * Termo de busca utilizado.
     *
     * @var string
     */
    public string $search = '';

    /**
     * Coluna para ordenar
     *
     * @var string
     */
    public string $sortField = 'created_at';

    /**
     * A direção do ordenamento
     *
     * @var string
     */
    public string $sortDirection = 'desc';

    /**
     * ID da proposta para filtragem
     *
     * @var string
     */
    public string $proposal = '';

    /**
     * ID da venda para filtragem
     *
     * @var string
     */
    public string $sale = '';


    /**
     * Ativa a queryString para facilitar o acesso aos filtros
     *
     * @var string[]
     */
    protected $queryString = [
        'search' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'proposal' => ['except' => ''],
        'sale' => ['except' => ''],
    ];

    /**
     * Redefine a páginação quando é realizada uma busca
     */
    public function updatingSearch()
    {
        $this->resetPage();
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

    public function render(SearchSales $searcher)
    {
        return view('livewire.manage-sales', ['sales' => $searcher->search(
            $this->search,
            $this->sortField,
            $this->sortDirection,
            $this->proposal,
            $this->sale
        )]);
    }
}
