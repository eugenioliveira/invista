<?php

namespace App\Http\Livewire\Proposal;

class WizardSteps
{
    const STEPS = [
        'proponent-step' => [
            'component' => 'proposal.proponent-step',
            'heading' => 'Primeiro passo: dados dos proponentes',
            'subheading' => 'Insira os dados do(s) proponente(s) para inicializar a proposta',
            'previousStep' => null,
            'nextStep' => 'financial-step'
        ]
    ];
}
