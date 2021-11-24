<?php

namespace App\Models;

use App\Casts\DecimalCast;
use App\Enums\ProposalStatusType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
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
        'negotiated_value' => DecimalCast::class . ':2',
        'down_payment' => DecimalCast::class . ':2',
        'installment_value' => DecimalCast::class . ':2'
    ];

    /**
     * O lote para o qual a proposta foi feita
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }

    /**
     * O usuário (corretor) que elaborou a proposta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Uma proposta pode ter vários status ao longo do tempo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses()
    {
        return $this->hasMany(ProposalStatus::class);
    }

    /**
     * Uma proposta pode ter vários documentos
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(ProposalDocument::class);
    }

    /**
     * Retorna o status mais recente da proposta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function latestStatus()
    {
        return $this->hasOne(ProposalStatus::class)->latestOfMany();
    }

    /**
     * Obtém o cliente para o qual foi realizada a proposta (Física ou Jurídica)
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function proposeable()
    {
        return $this->morphTo();
    }
}
