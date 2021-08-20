<?php

namespace App\Http\Livewire;

use App\Models\PaymentPlan;
use Illuminate\Support\Collection;
use Livewire\Component;
use Validator;

class PaymentPlanForm extends Component
{
    use RedirectHandler;

    /**
     * O plano de pagamento a ser atualizado
     *
     * @var PaymentPlan
     */
    public PaymentPlan $plan;

    /**
     * O estado do componente
     *
     * @var array
     */
    public array $state = [];

    /**
     * Os índices cadastrados para o Plano.
     *
     * @var Collection
     */
    public Collection $installmentIndexes;

    /**
     * O estado do índice que está sendo atualizado ou criado.
     *
     * @var array
     */
    public array $indexState = [
        'create' => ['installments' => '', 'index' => ''],
        'update' => ['installments' => '', 'index' => ''],
    ];

    /**
     * O identificador do índice que está sendo atualizado.
     *
     * @var mixed
     */
    public $editingIndexKey = null;

    /**
     * Prepara os dados para edição
     */
    public function mount()
    {
        $this->state = $this->plan->only([
            'name',
            'description',
            'min_down_payment'
        ]);

        $this->installmentIndexes = $this->plan->installment_indexes;
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createIndex()
    {
        // 1. Verificar se o numero de parcelas do índice já está cadastrada
        if ($this->checkExistingInstallments($this->indexState['create']['installments'])) {
            $this->addError('create.installments', 'Número de parcela já existe.');
        } else {
            // Validar
            $this->validateInstallmentIndexes('create', $this->indexState);
            // Efetivar a alteração
            $this->installmentIndexes->push($this->indexState['create']);
            $this->clearEditing();
        }
    }

    /**
     * Marca o índice selecionado como editável, e abre
     * as suas informações para edição no estado.
     *
     * @param $indexKey
     */
    public function editIndex($indexKey)
    {
        $this->editingIndexKey = $indexKey;
        $this->indexState['update'] = $this->installmentIndexes[$indexKey];
    }

    /**
     * Realiza a validação dos dados digitados e caso positivo persiste a alteração.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateIndex()
    {
        // 1. Verificar se o numero de parcelas do índice já está cadastrada
        if ($this->checkExistingInstallments($this->indexState['update']['installments'], $this->editingIndexKey)) {
            $this->addError('update.installments', 'Número de parcela já existe.');
        } else {
            // Validar
            $this->validateInstallmentIndexes('update', $this->indexState);
            // Efetivar a alteração
            $this->installmentIndexes[$this->editingIndexKey] = $this->indexState['update'];
            $this->clearEditing();
        }
    }

    /**
     * Remove o índice
     *
     * @param $indexKey
     */
    public function deleteIndex($indexKey)
    {
        $this->installmentIndexes->forget($indexKey);
    }

    /**
     * Verifica se a parcela a ser inserida/editada já existe.
     *
     * @param $installmentsToCheck
     * @param null $ignoredIndexKey
     * @return bool
     */
    protected function checkExistingInstallments($installmentsToCheck, $ignoredIndexKey = null): bool
    {
        $existingInstallments = $this->installmentIndexes->except($ignoredIndexKey)->pluck('installments');
        return $existingInstallments->contains($installmentsToCheck);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateInstallmentIndexes(string $context, array $input)
    {
        Validator::make($input,
            [
                $context.'.installments' => ['required', 'integer'],
                $context.'.index' => ['required', 'regex:/\d\.\d.+/']
            ],
            [
                $context.'.installments.required' => 'Insira um número de parcelas.',
                $context.'.installments.integer' => 'Digite um número de parcelas válido.',
                $context.'.index.required' => 'Insira um índice.',
                $context.'.index.regex' => 'Digite um índice válido.',
            ]
        )->validate();
    }

    /**
     * Limpa os campos de edição.
     */
    public function clearEditing()
    {
        $this->reset(['editingIndexKey', 'indexState']);
        $this->resetErrorBag();
    }

    public function savePaymentPlan($redirectAfterSave = true)
    {

    }

    public function render()
    {
        return view('livewire.payment-plan-form', [
            'indexes' => $this->installmentIndexes->sortBy('installments')
        ]);
    }
}
