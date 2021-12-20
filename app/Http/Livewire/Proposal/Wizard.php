<?php

namespace App\Http\Livewire\Proposal;

use App\Models\Lot;
use Livewire\Component;

class Wizard extends Component
{
    /**
     * O lote para o qual a proposta será realizada.
     *
     * @var Lot
     */
    public Lot $lot;

    /**
     * Todos os dados da proposta.
     *
     * @var mixed
     */
    public $state;

    /**
     * A configuração dos passos do formulário
     *
     * @var
     */
    public $steps;

    /**
     * O passo atual do formulário
     *
     * @var string
     */
    public $currentStep = 'proponent-step';

    /**
     * Inicialização do formulário
     *
     * @param Lot $lot
     */
    public function mount(Lot $lot)
    {
        $this->lot = $lot;
        $this->steps = WizardSteps::STEPS;
    }

    /**
     * Avança para o próximo passo do formulário
     */
    public function nextStep()
    {

    }

    public function render()
    {
        return view('livewire.proposal.wizard');
    }
}
