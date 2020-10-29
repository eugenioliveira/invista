<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class DecimalCast implements CastsAttributes
{
    /**
     * DecimalCast constructor.
     * @param int $digits
     */
    public function __construct(int $digits = 0)
    {
        app('decimal')->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $digits);
    }

    /**
     * Cast the given value.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        return app('decimal')->format($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        return app('decimal')->parse($value);
    }
}
