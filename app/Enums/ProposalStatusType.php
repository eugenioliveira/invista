<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static UNDER_REVIEW()
 * @method static static RETURNED()
 * @method static static DENIED()
 * @method static static ACCEPTED()
 */
final class ProposalStatusType extends Enum
{
    const UNDER_REVIEW = 1; // Proposta em análise; Valor padrão
    const RETURNED = 2; // Proposta devolvida para correção
    const DENIED = 3; // Proposta negada
    const ACCEPTED = 4; // Proposta aceita
}
