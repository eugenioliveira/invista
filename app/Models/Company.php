<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Retorna o endereço da empresa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

    /**
     * O usuário que criou a empresa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    /**
     * A empresa pode ter um ou mais sócios.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function shareholders()
    {
        return $this->belongsToMany(Person::class);
    }
}
