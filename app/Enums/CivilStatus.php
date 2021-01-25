<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

final class CivilStatus extends Enum implements LocalizedEnum
{
    const SINGLE = 1;
    const MARRIED = 2;
    const DIVORCED = 3;
    const WIDOW = 4;
}
