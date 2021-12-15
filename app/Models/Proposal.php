<?php

namespace App\Models;

use App\Casts\DecimalCast;
use App\Enums\ProposalStatusType;
use App\Enums\ProposalType;
use BenSampo\Enum\Traits\CastsEnums;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use CastsEnums;

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
        'installment_value' => DecimalCast::class . ':2',
        'type' => ProposalType::class
    ];

    /**
     * Serialização de accessors
     *
     * @var string[]
     */
    protected $appends = ['conditions'];

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

    /**
     * Retorna a reserva da qual partiu a proposta
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * Retorna o plano de pagamento escolhido no momento da criação da reserva.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paymentPlan()
    {
        return $this->belongsTo(PaymentPlan::class);
    }

    /**
     * Retorna a venda realizada através da proposta, caso haja.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sale()
    {
        return $this->hasOne(Sale::class);
    }

    /**
     * Adiciona um escopo para busca de propostas "ativas"
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->whereHas('latestStatus', function ($query) {
            $query->whereIn('type', [ProposalStatusType::UNDER_REVIEW, ProposalStatusType::RETURNED]);
        });
    }

    /**
     * Retorna as condições da proposta em formato literal.
     *
     * @return string
     */
    public function getConditionsAttribute()
    {
        if ($this->type === ProposalType::IN_CASH) {
            return 'Pagamento à vista em R$ ' . $this->negotiated_value;
        } else {
            return sprintf(
                'Pagamento em %s parcelas de %s',
                $this->installments,
                $this->installment_value;
        }
    }

    public function getUrlAttribute()
    {
        return route('proposals.index', ['proposal' => $this->id]);
    }
}
