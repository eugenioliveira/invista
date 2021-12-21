<?php

namespace App\Http\Livewire\Proposal;

class WizardSteps
{
    const STEPS = [
        'proponent-step' => [
            'component' => 'proposal.proponent-step',
            'dataLabel' => 'proponents',
            'heading' => 'Primeiro passo: dados dos proponentes',
            'subheading' => 'Insira os dados do(s) proponente(s) para inicializar a proposta',
            'previousStep' => null,
            'nextStep' => 'financial-step'
        ],

        'financial-step' => [
            'component' => 'proposal.financial-step',
            'dataLabel' => 'financial',
            'heading' => 'Segundo passo: proposta financeira',
            'subheading' => 'Preencha as informações a respeito da proposta em si.',
            'previousStep' => 'proponent-step',
            'nextStep' => 'document-step'
        ],

        'document-step' => [
            'component' => 'proposal.document-step',
            'dataLabel' => 'documents',
            'heading' => 'Terceiro passo: documentação',
            'subheading' => 'Envie os documentos necessários para conclusão da proposta.',
            'previousStep' => 'financial-step',
            'nextStep' => null
        ]
    ];
}
