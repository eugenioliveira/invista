<?php

namespace App\Http\Livewire;

use App\Actions\Allotment\UpdateAllotmentPaymentPlans;
use App\Models\Allotment;
use App\Models\PaymentPlan;
use Livewire\Component;

class AllotmentPaymentPlanForm extends Component
{
    use RedirectHandler;

    /**
     * O loteamento que terá seus planos de pagamento atualizados
     *
     * @var Allotment
     */
    public Allotment $allotment;

    /**
     * Os ID's dos planos selecionados
     *
     * @var array
     */
    public array $selectedPlans = [];

    /**
     * Montagem do componente
     *
     * @param Allotment $allotment
     */
    public function mount(Allotment $allotment)
    {
        $this->allotment = $allotment;
    }

    public function updatePlans(
        UpdateAllotmentPaymentPlans $updater,
        $redirectAfterUpdate = true
    ) {
        $updater->update($this->allotment, $this->selectedPlans);

        // Redireciona
        $this->successAction(
            'Planos de pagamento configurados.',
            ['allotments.index'],
            $redirectAfterUpdate
        );
    }

    public function render()
    {
        $allotmentPlans = $this->allotment
            ->plans()
            ->select(['id', 'name', 'description'])
            ->get();
        $availablePlans = PaymentPlan::whereNotIn(
            'id',
            $allotmentPlans->pluck('id')
        )
            ->select(['id', 'name', 'description'])
            ->get();
        return view('livewire.allotment-payment-plan-form', [
            'allotmentPlans' => $allotmentPlans,
            'availablePlans' => $availablePlans
        ]);
    }
}
