<?php

namespace App\Models;

use App\Casts\DecimalCast;
use App\Casts\TimeDurationCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Allotment extends Model
{
    use HasFactory;

    /**
     * Os atributos que devem ser convertidos.
     *
     * @var array
     */
    protected $casts = [
        'area' => DecimalCast::class,
        'max_discount' => DecimalCast::class,
        'allowable_margin' => DecimalCast::class,
        'reservation_duration' => TimeDurationCast::class
    ];

    /**
     * Desabilita a proteção contra mass assignment
     * uma vez que os campos serão validados.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Um loteamento está contido em uma cidade.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Um loteamento possui vários lotes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lots()
    {
        return $this->hasMany(Lot::class);
    }

    /**
     * Obtem a URL da foto de capa.
     *
     * @return string
     */
    public function getCoverUrlAttribute()
    {
        return $this->cover
            ? Storage::disk('public')->url($this->cover)
            : $this->defaultCoverUrl();
    }

    /**
     * Obtem uma foto de capa padrão caso nenhuma tenha sido enviada.
     *
     * @return string
     */
    protected function defaultCoverUrl()
    {
        return 'https://via.placeholder.com/500x150';
    }
}
