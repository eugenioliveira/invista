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
     * uma vez que os campos serão validados.
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
    protected $dates = ['init', 'due'];

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
     * Escopo de consulta para incluir apenas reservas ativas.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeActive(Builder $query)
    {
        return $query
            ->where('init', '<=', now())
            ->where('due', '>=', now());
    }
}
