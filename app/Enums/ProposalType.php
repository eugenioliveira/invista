<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static IN_CASH()
 * @method static static INSTALLMENTS()
 */
final class ProposalType extends Enum
{
    const IN_CASH =   1;
    const INSTALLMENTS =   2;
}
