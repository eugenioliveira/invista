<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static UNDER_REVIEW()
 * @method static static RETURNED()
 * @method static static DENIED()
 * @method static static ACCEPTED()
 */
final class ProposalStatusType extends Enum implements LocalizedEnum
{
    const UNDER_REVIEW = 1; // Proposta em análise; Valor padrão
    const DENIED = 2; // Proposta negada
    const ACCEPTED = 3; // Proposta aceita
}
