<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Desabilita a proteção contra mass assignment
     * visto que os campos serão validados.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Flag que indica que a entidade não terá
     * as timestamps padrão Laravel.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * As datas de reserva devem ser hidratadas
     *
     * @var string[]
     */
    protected $dates = ['init', 'due', 'cancelled_at'];

    /**
     * Uma reserva é efetuada por um usuário.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtém o cliente para o qual foi realizada a reserva (Física ou Jurídica)
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function reserveable()
    {
        return $this->morphTo();
    }

    /**
     * Escopo de consulta para incluir apenas reservas ativas.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query
            ->where('init', '<=', now())
            ->where('due', '>=', now())
            ->whereNull('cancelled_at');
    }

    /**
     * Realiza o cancelamento da reserva.
     *
     * @param string $reason
     * @return bool
     */
    public function cancel(string $reason): bool
    {
        $this->cancelled_at = now();
        $this->reason = $reason;

        return $this->save();
    }
}
