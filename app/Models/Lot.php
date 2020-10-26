<?php

namespace App\Models;

use App\Casts\CurrencyCast;
use App\Casts\DecimalCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    /**
     * Desabilita a proteção contra mass assignment
     * uma vez que os campos serão validados.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Os atributos que devem ser convertidos.
     *
     * @var array
     */
    protected $casts = [
        'price' => CurrencyCast::class,
        'front' => DecimalCast::class,
        'back' => DecimalCast::class,
        'right' => DecimalCast::class,
        'left' => DecimalCast::class
    ];

    /**
     * Um lote pertence à um loteamento.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function allotment()
    {
        return $this->belongsTo(Allotment::class);
    }

    /**
     * Retorna a identificação do lote.
     *
     * @return string
     */
    public function getIdentificationAttribute()
    {
        return "{$this->block}{$this->number}";
    }

    /**
     * Retorna a área total do lote formatada.
     *
     * @return mixed
     */
    public function getAreaAttribute()
    {
        $front = $this->attributes['front'];
        $back = $this->attributes['back'];
        $left = $this->attributes['left'];
        $right = $this->attributes['right'];

        return app('decimal')->format((($front + $back) / 2) * (($left + $right) / 2));
    }
}
