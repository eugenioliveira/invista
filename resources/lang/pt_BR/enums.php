<?php

use App\Enums\CivilStatus;
use App\Enums\LotStatusType;

return [
    LotStatusType::class => [
        LotStatusType::AVAILABLE => 'Disponível',
        LotStatusType::RESERVED => 'Reservado',
        LotStatusType::PROPOSED => 'Proposta',
        LotStatusType::BLOCKED => 'Bloqueado',
        LotStatusType::SOLD => 'Vendido',
        LotStatusType::PARTNER => 'Sócio'
    ],

    CivilStatus::class => [
        CivilStatus::SINGLE => 'Solteiro(a)',
        CivilStatus::MARRIED => 'Casado(a)',
        CivilStatus::DIVORCED => 'Divorciado(a)',
        CivilStatus::WIDOW => 'Viúvo(a)'
    ]
];
