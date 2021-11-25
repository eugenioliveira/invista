<?php

namespace App\Http\Livewire;

use App\Actions\Proposal\SearchProposals;
use App\Models\Proposal;
use Livewire\Component;
use Livewire\WithPagination;

class ManageProposals extends Component
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
    public string $sortField = 'created_at';

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
     * ID da proposta para filtragem
     *
     * @var string
     */
    public string $proposal = '';

    /**
     * Ativa a queryString para facilitar o acesso aos filtros
     *
     * @var string[]
     */
    protected $queryString = [
        'search' => ['except' => ''],
        'active' => ['except' => true],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
        'lot' => ['except' => ''],
        'proposal' => ['except' => '']
    ];

    /**
     * Controle de exibição dos filtros avançados.
     *
     * @var bool
     */
    public bool $showAdvancedFilters = false;

    public bool $showResolveProposalModal = false;

    /**
     * Os filtros de data a serem preenchidos
     *
     * @var array|null[]
     */
    public array $filters = [
        'created-at-min' => null,
        'created-at-max' => null,
        'type' => ''
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

    public function resolveProposal($proposalId)
    {
        Proposal::find($proposalId);
        $this->showResolveProposalModal = true;
    }

    public function render(SearchProposals $searcher)
    {
        return view('livewire.manage-proposals', [
            'proposals' => $searcher->search(
                $this->search,
                $this->filters,
                $this->sortField,
                $this->sortDirection,
                $this->active,
                $this->lot,
                $this->proposal
            )
        ]);
    }
}
