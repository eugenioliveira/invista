<?php

use App\Enums\LotStatusType;

return [
    LotStatusType::class => [
        LotStatusType::AVAILABLE => 'Disponível',
        LotStatusType::RESERVED => 'Reservado',
        LotStatusType::PROPOSED => 'Proposta',
        LotStatusType::BLOCKED => 'Bloqueado',
        LotStatusType::SOLD => 'Vendido',
        LotStatusType::PARTNER => 'Sócio'
    ]
];
