<?php

namespace App\Models;

use App\Casts\DecimalCast;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentPlan extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Conversão do campo de índices
     *
     * @var string[]
     */
    protected $casts = [
        'min_down_payment' => DecimalCast::class,
        'installment_indexes' => AsCollection::class,
    ];

    /**
     * Loteamentos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function allotments()
    {
        return $this->belongsToMany(Allotment::class);
    }
}
