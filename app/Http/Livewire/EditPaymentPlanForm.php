<?php

namespace App\Http\Livewire;

use App\Models\PaymentPlan;
use Illuminate\Support\Collection;
use Livewire\Component;

class EditPaymentPlanForm extends Component
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
     * O estado do índice a ser atualizado
     *
     * @var array|string[]
     */
    public array $indexState = ['installments' => '', 'index' => ''];

    /**
     * Os índices cadastrados para o Plano.
     *
     * @var Collection
     */
    public Collection $installmentIndexes;

    public function mount()
    {
        $this->state = $this->plan->only([
            'name',
            'description',
            'min_down_payment'
        ]);

        $this->installmentIndexes = $this->plan->installment_indexes;
    }

    public function updateIndex()
    {
        // 1. Verificar se o numero de parcelas do índice já está cadastrada
        // 2. Validar o número de parcelas
        // 3. Validar o número do índice
    }

    public function editIndex($indexKey)
    {
        $this->indexState = $this->installmentIndexes->get($indexKey);
    }

    public function deleteIndex($indexKey)
    {
        $this->installmentIndexes->forget($indexKey);
    }

    public function clearIndexState()
    {
        $this->reset('indexState');
    }

    public function render()
    {
        return view('livewire.edit-payment-plan-form');
    }
}
