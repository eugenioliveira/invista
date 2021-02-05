<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

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
