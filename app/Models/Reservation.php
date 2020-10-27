<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

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
}
