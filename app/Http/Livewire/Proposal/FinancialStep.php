<?php

namespace App\Http\Livewire\Proposal;

use App\Enums\ProposalType;
use App\Models\Lot;
use App\Models\PaymentPlan;
use App\Models\Proposal;
use Illuminate\Support\Collection;
use Livewire\Component;

class FinancialStep extends Component
{
    public $lot;
    public $proposal;

    /**
     * Os dados da proposta
     *
     * @var Collection
     */
    public Collection $proposalData;

    /**
     * O valor negociado do lote no caso de proposta à vista
     *
     * @var string
     */
    public string $negotiated = '';

    /**
     * O valor de entrada do lote no caso de proposta parcelada
     *
     * @var string
     */
    public string $downPayment = '';

    /**
     * A data de pagamento da entrada
     *
     * @var string
     */
    public string $paymentDate = '';

    /**
     * A data de pagamento da primeira parcela
     *
     * @var string
     */
    public string $installmentDate = '';

    /**
     * O ID do plano de pagamento selecionado
     *
     * @var string
     */
    public string $selectedPaymentPlan = '';

    /**
     * O plano de pagamento selecionado
     *
     * @var PaymentPlan
     */
    public PaymentPlan $paymentPlan;

    /**
     * A lista de parcelas simuladas
     *
     * @var Collection
     */
    public Collection $simulatedInstallments;

    public $isOK = false;

    /**
     * O índice do plano de pagamento selecionado
     *
     * @var string
     */
    public string $selectedInstallmentValue = '';

    protected $listeners = ['reportData' => 'sendData'];

    /**
     * Realiza a configuração inicial de alguns campos
     */
    public function mount(Lot $lot, Proposal $proposal)
    {
        $this->lot = $lot;
        $this->proposal = $proposal;
        $this->simulatedInstallments = collect([]);

        $this->proposalData = collect([
            'type' => 2,
            'negotiated_value' => '',
            'down_payment' => '',
            'payment_date' => '',
            'installment_date' => '',
            'comments' => ''
        ]);

        if ($this->proposal->getAttributes()) {
            $this->proposalData['type'] = $this->proposal->type->value;
            $this->negotiated = $this->proposal->negotiated_value;
            $this->proposalData['negotiated_value'] = $this->proposal->negotiated_value;
            $this->downPayment = $this->proposal->down_payment;
            $this->proposalData['down_payment'] = $this->proposal->down_payment;
            $this->paymentDate = $this->proposal->payment_date;
            $this->proposalData['payment_date'] = $this->proposal->payment_date;
            $this->installmentDate = $this->proposal->installment_date;
            $this->proposalData['installment_date'] = $this->proposal->installment_date;
            $this->proposalData['comments'] = $this->proposal->comments;

            // Atualiza com o parcelamento escolhido, caso haja
            if ($this->proposal->paymentPlan) {
                $this->paymentPlan = $this->proposal->paymentPlan;
                $this->proposalData['payment_plan_id'] = $this->paymentPlan->id;
                $this->selectedPaymentPlan = $this->paymentPlan->id;
                $this->refreshSimulatedInstallments($this->paymentPlan->installment_indexes, $proposal->lot->price);
            }
        }
    }

    /**
     * Atualiza o parcelamento baseado nos dados inseridos
     *
     * @param $lotPrice
     */
    protected function refreshSimulatedInstallments($indexes, $lotPrice)
    {
        $this->simulatedInstallments = collect([]);

        $parsedLotPrice = app('decimal')->parse($lotPrice);
        $lotPrice = $parsedLotPrice !== false ? $parsedLotPrice : $lotPrice;
        $parsedDownPayment = app('decimal')->parse($this->proposalData['down_payment']);
        $downPayment = $parsedDownPayment !== false ? $parsedDownPayment : $this->proposalData['down_payment'];

        foreach ($indexes as $index) {
            $this->simulatedInstallments->push([
                'installments' => $index['installments'],
                'value' => $index['index'] * ($lotPrice - $downPayment)
            ]);
        }
    }

    public function updatedSelectedPaymentPlan()
    {
        $this->paymentPlan = PaymentPlan::findOrFail($this->selectedPaymentPlan);
        $this->proposalData['payment_plan_id'] = $this->paymentPlan->id;
    }

    public function updatedNegotiated()
    {
        if ($this->proposalData['type'] !== ProposalType::FREE) {
            $price = app('decimal')->parse($this->lot->price);
            $maxDiscount = app('decimal')->parse($this->lot->allotment->max_discount) / 100;
            $minValue = round($price - $price * $maxDiscount, 2);

            $this->validateOnly(
                'negotiated',
                [
                    'negotiated' => ['required']
                ],
                [
                    'negotiated.required' => 'Digite o valor negociado entre as partes.'
                ]
            );

            if (app('decimal')->parse($this->negotiated) < $minValue) {
                $this->addError('negotiated', sprintf('O valor mínimo é %s', app('currency')->format($minValue)));
            }

            if (app('decimal')->parse($this->negotiated) > $price) {
                $this->addError('negotiated', sprintf('O valor máximo é %s', app('currency')->format($price)));
            }
        }

        $this->proposalData['negotiated_value'] = $this->negotiated;
    }

    public function updatedDownPayment()
    {
        $price = app('decimal')->parse($this->lot->price);
        $minDownPayment = app('decimal')->parse($this->paymentPlan->min_down_payment) / 100;
        $minValue = round($price * $minDownPayment, 2);
        $this->validateOnly('downPayment', [
            'downPayment' => ['required']
        ]);

        if (app('decimal')->parse($this->downPayment) < $minValue) {
            $this->addError(
                'downPayment',
                sprintf('O valor mínimo de entrada é %s', app('currency')->format($minValue))
            );
        }

        $this->proposalData['down_payment'] = $this->downPayment;

        $this->refreshSimulatedInstallments($this->paymentPlan->installment_indexes, $price);
    }

    public function sendData()
    {
        $validationRules = ['paymentDate' => 'required'];
        $validationMessages = ['paymentDate.required' => 'Digite a data de pagamento da entrada/sinal.'];
        $price = $this->lot->price;
        $this->proposalData['payment_date'] = $this->paymentDate;
        $this->proposalData['installment_date'] = $this->installmentDate;

        if (
            $this->proposalData['type'] === ProposalType::IN_CASH ||
            $this->proposalData['type'] === ProposalType::FREE
        ) {
            $validationRules['negotiated'] = 'required';
            $validationMessages['negotiated.required'] = 'Digite o valor negociado';
        } else {
            $validationRules['downPayment'] = 'required';
            $validationMessages['downPayment.required'] = 'Digite o valor de entrada.';
            $validationRules['installmentDate'] = 'required';
            $validationMessages['installmentDate.required'] = 'Digite a data de pagamento da primeira parcela.';
        }

        $this->validate($validationRules, $validationMessages);
        if ($this->proposalData['type'] === ProposalType::IN_CASH) {
            $this->proposalData = $this->proposalData->merge([
                'down_payment' => 0,
                'installments' => 1,
                'installment_value' => $this->proposalData['negotiated_value']
            ]);
        } elseif ($this->proposalData['type'] === ProposalType::INSTALLMENTS) {
            if ($this->lot->allotment->plans->isEmpty()) {
                throw new \Exception(
                    'Não é possível fazer uma proposta de pagamento parcelada pois não há plano de pagamento parcelado associado ao loteamento. Favor, entre em contato com o administrador.'
                );
            } else {
                $this->validate(
                    [
                        'downPayment' => 'required',
                        'selectedPaymentPlan' => 'required',
                        'selectedInstallmentValue' => 'required'
                    ],
                    [
                        'downPayment.required' => 'Digite um valor de entrada.',
                        'selectedPaymentPlan.required' => 'Selecione um dos planos de pagamento acima.',
                        'selectedInstallmentValue.required' => 'Selecione um plano de parcelamento.'
                    ]
                );
                $this->proposalData = $this->proposalData->merge([
                    'negotiated_value' => $price,
                    'installments' => $this->simulatedInstallments[$this->selectedInstallmentValue]['installments'],
                    'installment_value' => app('decimal')->format(
                        $this->simulatedInstallments[$this->selectedInstallmentValue]['value']
                    )
                ]);
            }
        } else {
            $this->proposalData = $this->proposalData->merge([
                'down_payment' => 0,
                'installments' => 1,
                'installment_value' => $this->proposalData['negotiated_value']
            ]);
        }

        $this->emitUp('financialData', $this->proposalData);
    }

    public function render()
    {
        return view('livewire.proposal.financial-step');
    }
}
