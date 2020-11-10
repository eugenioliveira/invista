<?php

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static AVAILABLE()
 * @method static static RESERVED()
 * @method static static PROPOSED()
 * @method static static BLOCKED()
 * @method static static SOLD()
 * @method static static PARTNER()
 */
final class LotStatusType extends Enum implements LocalizedEnum
{
    const AVAILABLE = 1;
    const RESERVED = 2;
    const PROPOSED = 3;
    const BLOCKED = 4;
    const SOLD = 5;
    const PARTNER = 6;

}