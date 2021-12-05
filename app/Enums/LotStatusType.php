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
 */
final class LotStatusType extends Enum implements LocalizedEnum
{
    const AVAILABLE = 1;
    const RESERVED = 2;
    const PROPOSED = 3;
    const BLOCKED = 4;
    const SOLD = 5;

    public array $colors = [
        self::AVAILABLE => 'green',
        self::RESERVED => 'yellow',
        self::PROPOSED => 'red',
        self::BLOCKED => 'gray',
        self::SOLD => 'red'
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
            static::SOLD()
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
