<?php

namespace App\Models;

use App\Casts\DecimalCast;
use App\Events\LotSold;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
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
        'value' => DecimalCast::class . ':2'
    ];

    /**
     * Retorna a proposta que gerou a venda.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    /**
     * O lote para o qual a venda foi feita
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    /**
     * O usuário (corretor) que efetuou a venda
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtém o cliente para o qual foi realizada a venda (Física ou Jurídica)
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function salable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return route('sales.index', ['sale' => $this->id]);
    }
}
