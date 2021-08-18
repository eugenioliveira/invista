<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static SINGLE()
 * @method static static MARRIED()
 * @method static static DIVORCED()
 * @method static static WIDOW()
 */
final class CivilStatus extends Enum implements LocalizedEnum
{
    const SINGLE = 1;
    const MARRIED = 2;
    const DIVORCED = 3;
    const WIDOW = 4;
}
