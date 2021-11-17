<?php

namespace App\Http\Livewire;

use App\Actions\Person\UpdatePersonDetail;
use App\Actions\Proposal\CreateNewProposal;
use App\Enums\CivilStatus;
use App\Enums\ProposalType;
use App\Enums\ProposalWizardSteps;
use App\Models\Lot;
use App\Models\PaymentPlan;
use App\Models\Person;
use App\Models\ProposalDocument;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ProposalWizard extends Component
{
    use WithFileUploads;

    /**
     * O lote para o qual será criada uma proposta
     *
     * @var Lot
     */
    public Lot $lot;

    /**
     * O passo atual do formulário
     *
     * @var int
     */
    public int $currentStep = ProposalWizardSteps::CLIENT_STEP;

    /**
     * A configuração de cada passo
     *
     * @var array|string[]
     */
    public array $stepsConfig = [
        ProposalWizardSteps::CLIENT_STEP => [
            'heading' => 'Primeiro passo: dados do cliente',
            'subheading' =>
                'Insira os dados complementares para a elaboração da proposta',
            'method' => 'submitClientStep'
        ],

        ProposalWizardSteps::FINANCIAL_STEP => [
            'heading' => 'Segundo passo: proposta financeira',
            'subheading' =>
                'Preencha as informações a respeito da proposta em si.',
            'method' => 'submitFinancialStep'
        ],

        ProposalWizardSteps::DOCUMENT_STEP => [
            'heading' => 'Terceiro passo: documentação',
            'subheading' =>
                'Envie os documentos necessários para conclusão da proposta',
            'method' => 'submitDocumentStep'
        ]
    ];

    /**
     * Os dados do cliente
     *
     * @var array
     */
    public array $clientData = [];

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

    /**
     * O índice do plano de pagamento selecionado
     *
     * @var string
     */
    public string $selectedInstallmentValue = '';

    /**
     * A lista de documentos para envio da proposta
     *
     * @var mixed
     */
    public $documents = [];

    /**
     * Realiza a configuração inicial de alguns campos
     */
    public function mount()
    {
        $this->clientData['civil_status'] = CivilStatus::SINGLE();
        $this->proposalData = collect([
            'type' => 2,
            'negotiated_value' => '',
            'down_payment' => '',
            'comments' => ''
        ]);
        $this->simulatedInstallments = collect([]);
    }

    public function updatedNegotiated()
    {
        $this->proposalData['negotiated_value'] = app('decimal')->parse(
            $this->negotiated
        );
    }

    public function updatedDownPayment()
    {
        $price = app('decimal')->parse($this->lot->price);
        $minDownPayment =
            app('decimal')->parse($this->paymentPlan->min_down_payment) / 100;
        $minValue = $price * $minDownPayment;
        $this->validateOnly(
            'downPayment',
            [
                'downPayment' => ['required', 'numeric', "min:{$minValue}"]
            ],
            [
                'downPayment.min' => sprintf(
                    'O valor mínimo de entrada é %s.',
                    app('currency')->format($minValue)
                )
            ]
        );

        $this->proposalData['down_payment'] = app('decimal')->parse(
            $this->downPayment
        );

        $this->simulatedInstallments = collect([]);

        foreach ($this->paymentPlan->installment_indexes as $index) {
            $this->simulatedInstallments->push([
                'installments' => $index['installments'],
                'value' =>
                    $index['index'] *
                    ($price - $this->proposalData['down_payment'])
            ]);
        }
    }

    public function updatedSelectedPaymentPlan()
    {
        $this->paymentPlan = PaymentPlan::findOrFail(
            $this->selectedPaymentPlan
        );
    }

    /**
     * Avança um passo do formmulário
     */
    public function increaseStep()
    {
        $this->currentStep++;
    }

    /**
     * Retrocede um passo do formulário
     */
    public function decreaseStep()
    {
        $this->currentStep--;
    }

    /**
     * Executa o próximo passo da lista.
     */
    public function nextStep()
    {
        $stepMethod = $this->stepsConfig[$this->currentStep]['method'];

        if (is_callable([$this, $stepMethod])) {
            $this->$stepMethod();
            $this->increaseStep();
        }
    }

    /**
     * Realiza a submissão dos dados do primeiro passo.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function submitClientStep()
    {
        $this->clientData = (new UpdatePersonDetail())->validate(
            $this->clientData
        );
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function submitFinancialStep()
    {
        $price = app('decimal')->parse($this->lot->price);

        if ($this->proposalData['type'] === ProposalType::IN_CASH) {
            // Validar e preencher a proposta à vista
            $maxDiscount =
                app('decimal')->parse($this->lot->allotment->max_discount) /
                100;
            $minValue = $price - $price * $maxDiscount;
            $this->validateOnly(
                'proposalData.negotiated_value',
                [
                    'proposalData.negotiated_value' => [
                        'required',
                        'numeric',
                        "min:{$minValue}",
                        "max:{$price}"
                    ]
                ],
                [
                    'proposalData.negotiated_value.required' =>
                        'Digite o valor negociado entre as partes.',
                    'proposalData.negotiated_value.numeric' =>
                        'Digite um valor válido.',
                    'proposalData.negotiated_value.min' => sprintf(
                        'O valor mínimo é %s.',
                        app('currency')->format($minValue)
                    ),
                    'proposalData.negotiated_value.max' => sprintf(
                        'O valor máximo é %s.',
                        app('currency')->format($price)
                    )
                ]
            );
            $this->proposalData = $this->proposalData->merge([
                'down_payment' => 0,
                'installments' => 1,
                'installment_value' => $this->proposalData['negotiated_value']
            ]);
        } else {
            if ($this->lot->allotment->plans->isEmpty()) {
                throw new \Exception(
                    'Não é possível fazer uma proposta de pagamento parcelada pois não há plano de pagamento parcelado associado ao loteamento. Favor, entre em contato com o administrador.'
                );
            } else {
                $this->validate(
                    [
                        'downPayment' => 'required',
                        'selectedInstallmentValue' => 'required'
                    ],
                    [
                        'downPayment.required' => 'Digite um valor de entrada.',
                        'selectedInstallmentValue.required' =>
                            'Selecione um plano de parcelamento.'
                    ]
                );
                $this->proposalData = $this->proposalData->merge([
                    'negotiated_value' => $price,
                    'down_payment' => $this->downPayment,
                    'installments' =>
                        $this->simulatedInstallments[
                            $this->selectedInstallmentValue
                        ]['installments'],
                    'installment_value' =>
                        $this->simulatedInstallments[
                            $this->selectedInstallmentValue
                        ]['value']
                ]);
            }
        }
    }

    public function submitProposal(
        UpdatePersonDetail $clientUpdater,
        CreateNewProposal $proposalCreator
    ) {
        $this->validate(
            [
                'documents' => ['required'],
                'documents.*' => ['mimes:jpg,png,pdf']
            ],
            [
                'documents.required' => 'Adicione os arquivos de documentos.',
                'documents.*.mimes' =>
                    'Os documentos devem ser dos tipos JPG, PNG ou PDF.'
            ]
        );

        \DB::beginTransaction();

        try {
            // Salva as informações do cliente
            $clientUpdater->update(
                $this->lot->activeReservation->reserveable,
                $this->clientData
            );
            // Salva as informações da proposta
            $proposal = $proposalCreator->create(
                $this->lot,
                \Auth::user(),
                $this->lot->activeReservation->reserveable,
                $this->proposalData
            );
            // Salva os documentos da proposta
            /** @var TemporaryUploadedFile $document */
            foreach ($this->documents as $document) {
                $filename = $document->store('/', 'documents');
                $proposal->documents()->create(['filename' => $filename]);
            }

            \DB::commit();
        } catch (\Exception $e) {
            throw $e;
            \DB::rollBack();
        }
    }

    public function render()
    {
        return view('livewire.proposal-wizard');
    }
}
