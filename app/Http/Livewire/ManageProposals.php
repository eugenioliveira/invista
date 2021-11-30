<?php

namespace App\Http\Livewire;

use App\Actions\Proposal\ResolveProposalFactory;
use App\Actions\Proposal\SearchProposals;
use App\Enums\ProposalStatusType;
use App\Models\Proposal;
use BenSampo\Enum\Rules\EnumValue;
use Livewire\Component;
use Livewire\WithPagination;

class ManageProposals extends Component
{
    use WithPagination, RedirectHandler;

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

    /**
     * Controle de exibição do modal de resolução da proposta.
     *
     * @var bool
     */
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
     * A proposta que será resolvida
     *
     * @var Proposal
     */
    public Proposal $resolving;

    /**
     * Resultado da avaliação da proposta
     *
     * @var array
     */
    public array $resolveData = [
        'status' => '',
        'reason' => null,
    ];

    /**
     * Regras de validação
     *
     * @return array
     */
    public function rules()
    {
        return [
            'resolveData.status' => ['required', new EnumValue(ProposalStatusType::class, false)],
            'resolveData.reason' => ['required', 'min:10']
        ];
    }

    /**
     * Mensagens de erro de validação
     *
     * @return string[]
     */
    public function messages()
    {
        return [
            'resolveData.status.required' => 'Selecione um status.',
            'resolveData.reason.required' => 'Digite um motivo para a resolução da proposta.',
            'resolveData.reason.min' => 'Digite um motivo com no mínimo 10 caracteres.',
        ];
    }

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
     * Marca a proposta selecionada para resolução e exibe o modal
     *
     * @param Proposal $proposal
     */
    public function showResolveProposal(Proposal $proposal)
    {
        $this->resetErrorBag();
        $this->reset('resolveData');
        $this->resolving = $proposal;
        $this->showResolveProposalModal = true;
    }

    /**
     * Efetua a resolução da proposta.
     */
    public function resolveProposal(ResolveProposalFactory $resolverFactory)
    {
        $this->validate();

        $resolver = $resolverFactory->make(ProposalStatusType::fromValue((int)$this->resolveData['status']));
        $resolveResult = $resolver->resolve($this->resolving, $this->resolveData['reason']);
        if ($resolveResult) {
            $this->successAction(
                sprintf(
                    'Sucesso: Proposta #%s resolvida como %s',
                    $this->resolving->id,
                    $resolveResult->type->description
                ),
                ['proposals.index'],
                true
            );
        }
    }

    /**
     * Renderiza o componente
     *
     * @param SearchProposals $searcher
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
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
