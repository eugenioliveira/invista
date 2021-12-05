<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    use HasFactory;

    /**
     * Desabilita proteção contra Mass Assignment
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'position' => 'array'
    ];

    /**
     * O lote associado ao marcador
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }
}
