<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Map extends Model
{
    use HasFactory;

    /**
     * Desabilita proteção contra Mass Assignment
     *
     * @var array
     */
    protected $guarded = [];

    protected $casts = [
        'bounds' => 'array'
    ];

    public function allotment()
    {
        return $this->belongsTo(Allotment::class);
    }

    /**
     * Retorna os marcadores do mapa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function markers()
    {
        return $this->hasMany(Marker::class);
    }
}
