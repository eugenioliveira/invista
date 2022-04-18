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
 * @method static static AVAILABLE_CASH()
 */
final class LotStatusType extends Enum implements LocalizedEnum
{
    const AVAILABLE = 1;
    const RESERVED = 2;
    const PROPOSED = 3;
    const BLOCKED = 4;
    const SOLD = 5;
    const AVAILABLE_CASH = 6;

    public array $colors = [
        self::AVAILABLE => 'green',
        self::RESERVED => 'yellow',
        self::PROPOSED => 'red',
        self::BLOCKED => 'gray',
        self::SOLD => 'red',
        self::AVAILABLE_CASH => 'orange'
    ];

    /**
     * Retorna todos os status estáticos.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function staticStatuses()
    {
        return collect([
            static::AVAILABLE(),
            static::BLOCKED(),
            static::SOLD(),
            static::AVAILABLE_CASH()
        ]);
    }

    /**
     * Retorna a cor do status
     *
     * @return mixed|string
     */
    public function color()
    {
        return $this->colors[$this->value];
    }
}
