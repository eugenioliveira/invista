<?php

namespace App\Http\Livewire;

use App\Actions\Person\UpdatePersonDetail;
use App\Actions\Proposal\CreateNewProposal;
use App\Actions\Proposal\UpdateProposal;
use App\Enums\CivilStatus;
use App\Enums\ProposalType;
use App\Enums\ProposalWizardSteps;
use App\Events\ProposalCreated;
use App\Events\ProposalUpdated;
use App\Models\Lot;
use App\Models\PaymentPlan;
use App\Models\PersonDetail;
use App\Models\Proposal;
use App\Models\ProposalDocument;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ProposalWizard extends Component
{
    use WithFileUploads, RedirectHandler, AuthorizesRequests;

    /**
     * O lote para o qual será criada uma proposta
     *
     * @var Lot
     */
    public Lot $lot;

    /**
     * A proposta que será editada
     *
     * @var Proposal
     */
    public Proposal $proposal;

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
            'subheading' => 'Insira os dados complementares para a elaboração da proposta',
            'method' => 'submitClientStep'
        ],

        ProposalWizardSteps::FINANCIAL_STEP => [
            'heading' => 'Segundo passo: proposta financeira',
            'subheading' => 'Preencha as informações a respeito da proposta em si.',
            'method' => 'submitFinancialStep'
        ],

        ProposalWizardSteps::DOCUMENT_STEP => [
            'heading' => 'Terceiro passo: documentação',
            'subheading' => 'Envie os documentos necessários para conclusão da proposta',
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
     * Event listeners
     *
     * @var string[]
     */
    protected $listeners = ['documentRemoved' => 'render'];

    /**
     * Realiza a configuração inicial de alguns campos
     */
    public function mount(Lot $lot, Proposal $proposal)
    {
        $this->lot = $lot;
        $this->proposal = $proposal;
        $this->simulatedInstallments = collect([]);

        $detail = collect($this->lot->activeReservation->reserveable->detail)->except([
            'partner_id',
            'created_at',
            'updated_at'
        ]);

        if ($detail->isNotEmpty()) {
            $this->clientData = $detail->toArray();
            $this->clientData['monthly_income'] = app('decimal')->parse($detail['monthly_income']);
        } else {
            $this->clientData['civil_status'] = CivilStatus::SINGLE;
        }

        $this->proposalData = collect([
            'type' => 2,
            'negotiated_value' => '',
            'down_payment' => '',
            'comments' => ''
        ]);

        if ($this->proposal->getAttributes()) {
            $this->proposalData['type'] = $this->proposal->type->value;
            $this->negotiated = $this->proposal->negotiated_value;
            $this->proposalData['negotiated_value'] = $this->proposal->negotiated_value;
            $this->downPayment = $this->proposal->down_payment;
            $this->proposalData['down_payment'] = $this->proposal->down_payment;
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

    public function updatedNegotiated()
    {
        $price = app('decimal')->parse($this->lot->price);
        $maxDiscount = app('decimal')->parse($this->lot->allotment->max_discount) / 100;
        $minValue = round($price - $price * $maxDiscount, 2);

        $this->validateOnly(
            'negotiated',
            [
                'negotiated' => ['required']
            ],
            [
                'negotiated.required' => 'Digite o valor negociado entre as partes.',
            ]
        );

        if (app('decimal')->parse($this->negotiated) < $minValue) {
            $this->addError('negotiated', sprintf('O valor mínimo é %s', app('currency')->format($minValue)));
        }

        if (app('decimal')->parse($this->negotiated) > $price) {
            $this->addError('negotiated', sprintf('O valor máximo é %s', app('currency')->format($price)));
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
        $this->clientData = (new UpdatePersonDetail())->validate($this->clientData);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Exception
     */
    public function submitFinancialStep()
    {
        $price = $this->lot->price;
        if ($this->proposalData['type'] === ProposalType::IN_CASH) {
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
                    'installment_value' => app('decimal')->format($this->simulatedInstallments[$this->selectedInstallmentValue]['value'])
                ]);
            }
        }
    }

    /**
     * @throws \Throwable
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function submitProposal(UpdatePersonDetail $clientUpdater, CreateNewProposal $proposalCreator, UpdateProposal $proposalUpdater)
    {
        if ($this->proposal->documents->isEmpty()) {
            $this->validate(
                [
                    'documents' => ['required'],
                    'documents.*' => ['mimes:jpg,png,pdf']
                ],
                [
                    'documents.required' => 'Adicione os arquivos de documentos.',
                    'documents.*.mimes' => 'Os documentos devem ser dos tipos JPG, PNG ou PDF.'
                ]
            );
        }

        \DB::beginTransaction();

        $action = '';

        try {
            // Salva as informações do cliente
            $clientUpdater->update($this->lot->activeReservation->reserveable, $this->clientData);
            // Salva as informações da proposta
            if ($this->proposal->getAttributes()) {
                $this->authorize('editProposal', [Proposal::class, $this->proposal]);
                $proposal = $proposalUpdater->update($this->proposal, \Auth::user(), $this->proposalData);
                $action = 'update';
            } else {
                $this->authorize('create', [Proposal::class, $this->lot]);
                $proposal = $proposalCreator->create(
                    $this->lot,
                    \Auth::user(),
                    $this->lot->activeReservation->reserveable,
                    $this->proposalData
                );
                $action = 'create';
            }
            // Salva os documentos da proposta
            /** @var TemporaryUploadedFile $document */
            foreach ($this->documents as $document) {
                $filename = $document->store('/', 'documents');
                $proposal->documents()->create(['filename' => $filename]);
            }

            \DB::commit();

            // Dispara o evento correto
            if ($action === 'create') {
                ProposalCreated::dispatch($proposal->refresh());
            } else {
                ProposalUpdated::dispatch($proposal->refresh());
            }

            // Redireciona
            $this->successAction('Proposta realizada.', ['lots.index', $proposal->lot->allotment_id], true);
        } catch (\Exception $e) {
            throw $e;
            \DB::rollBack();
        }
    }

    public function deleteDocument(ProposalDocument $document)
    {
        $document->delete();
        $this->emit('documentRemoved');
    }

    public function render()
    {
        return view('livewire.proposal-wizard');
    }
}
