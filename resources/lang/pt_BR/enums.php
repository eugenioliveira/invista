<?php

use App\Enums\CivilStatus;
use App\Enums\LotStatusType;
use App\Enums\ProposalStatusType;
use App\Enums\ProposalType;

return [
    LotStatusType::class => [
        LotStatusType::AVAILABLE => 'Disponível',
        LotStatusType::RESERVED => 'Reservado',
        LotStatusType::PROPOSED => 'Proposta ativa',
        LotStatusType::BLOCKED => 'Bloqueado',
        LotStatusType::SOLD => 'Vendido'
    ],

    CivilStatus::class => [
        CivilStatus::SINGLE => 'Solteiro(a)',
        CivilStatus::MARRIED => 'Casado(a)',
        CivilStatus::DIVORCED => 'Divorciado(a)',
        CivilStatus::WIDOW => 'Viúvo(a)'
    ],

    ProposalType::class => [
        ProposalType::IN_CASH => 'À vista',
        ProposalType::INSTALLMENTS => 'Parcelada',
        ProposalType::FREE => 'Proposta livre'
    ],

    ProposalStatusType::class => [
        ProposalStatusType::UNDER_REVIEW => 'Em análise',
        ProposalStatusType::RETURNED => 'Devolvida',
        ProposalStatusType::ACCEPTED => 'Aceita',
        ProposalStatusType::DENIED => 'Negada'
    ]
];
