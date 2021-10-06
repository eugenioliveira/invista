<?php

namespace App\Http\Livewire;

use App\Actions\Person\UpdatePersonDetail;
use App\Enums\CivilStatus;
use App\Enums\ProposalWizardSteps;
use App\Models\Lot;
use Livewire\Component;

class ProposalWizard extends Component
{
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
        ]
    ];

    /**
     * Os dados do cliente
     *
     * @var array
     */
    public array $clientData = [];

    /**
     * Realiza a configuração inicial de alguns campos
     */
    public function mount()
    {
        $this->clientData['civil_status'] = CivilStatus::SINGLE();
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

    public function render()
    {
        return view('livewire.proposal-wizard');
    }
}
