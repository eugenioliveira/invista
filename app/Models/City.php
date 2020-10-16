<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
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
     * Uma cidade possui vários loteamentos.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function allotments()
    {
        return $this->hasMany(Allotment::class);
    }
}
