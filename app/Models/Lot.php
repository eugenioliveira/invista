<?php

namespace App\Models;

use App\Casts\DecimalCast;
use App\Enums\LotStatusType;
use App\Enums\ProposalStatusType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lot extends Model
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
        'price' => DecimalCast::class . ':2',
        'front' => DecimalCast::class,
        'back' => DecimalCast::class,
        'right' => DecimalCast::class,
        'left' => DecimalCast::class
    ];

    /**
     * Um lote pertence à um loteamento.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function allotment()
    {
        return $this->belongsTo(Allotment::class);
    }

    /**
     * Um lote pode ter vários status ao longo do tempo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function statuses()
    {
        return $this->hasMany(LotStatus::class);
    }

    /**
     * Um lote pode possuir várias reservas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    /**
     * Um lote pode possuir várias reservas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Retorna a venda do lote, caso haja.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sale()
    {
        return $this->hasOne(Sale::class);
    }

    /**
     * Retorna o status mais recente do lote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function latestStatus()
    {
        return $this->hasOne(LotStatus::class)->latestOfMany();
    }

    /**
     * Retorna o marcador relacionado ao lote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function marker()
    {
        return $this->hasOne(Marker::class);
    }

    /**
     * Retorna a reserva ativa do lote.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activeReservation()
    {
        return $this->hasOne(Reservation::class)->ofMany(['id' => 'max'], fn($query) => $query->active());
    }

    /**
     * Retorna uma proposta, caso preencha os seguintes requisitos:
     * Pertença ao lote atual;
     * Tenha o último estado registrado como em análise ou devolvida.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activeProposal()
    {
        return $this->hasOne(Proposal::class)->ofMany(['id' => 'max'], fn($query) => $query->active());
    }

    /**
     * Retorna a identificação do lote.
     *
     * @return string
     */
    public function getIdentificationAttribute()
    {
        return "{$this->block}{$this->number}";
    }

    /**
     * Retorna a área total do lote formatada.
     *
     * @return mixed
     */
    public function getAreaAttribute()
    {
        $front = $this->attributes['front'];
        $back = $this->attributes['back'];
        $right = $this->attributes['right'];
        $left = $this->attributes['left'];

        return app('decimal')->format((($front + $back) / 2) * (($left + $right) / 2));
    }

    /**
     * Retorna o preço do lote formatado em pt-BR
     *
     * @return mixed
     */
    public function getFormattedPriceAttribute()
    {
        return app('currency')->format($this->attributes['price']);
    }

    /**
     * Retorna as confrontações do lote.
     *
     * @return array
     */
    public function getSides()
    {
        return [
            sprintf('%s metros de frente com %s', $this->front, $this->front_side),
            sprintf('%s metros de fundos com %s', $this->back, $this->back_side),
            sprintf('%s metros de lado direito com %s', $this->right, $this->right_side),
            sprintf('%s metros de lado esquerdo com %s', $this->left, $this->left_side)
        ];
    }

    /**
     * Obtém o status atual do lote.
     *
     * @return LotStatus|object|null
     */
    public function getStatus()
    {
        // Verifica se o lote possui alguma proposta ativa
        $activeProposal = $this->activeProposal;
        // caso haja, cria um Status do tipo proposta ativa.
        if ($activeProposal) {
            return $this->createProposedStatus($activeProposal);
        }
        // Verifica se o lote possui alguma reserva ativa
        $activeReservation = $this->activeReservation;
        // caso haja, cria um Status do tipo reservado.
        if ($activeReservation) {
            return $this->createReservedStatus($activeReservation);
        }

        // Caso não exista nem reserva nem proposta, retorna o primeiro status
        // estático encontrado.
        return $this->latestStatus;
    }

    /**
     * Cria um status para o lote atual.
     *
     * @param User $user
     * @param int $type
     * @param string $reason
     * @param bool $save
     * @return mixed
     */
    public function createStatus(User $user, int $type, string $reason, $save = true)
    {
        $lotStatus = new LotStatus([
            'user_id' => $user->id,
            'type' => $type,
            'reason' => $reason
        ]);

        if ($save) {
            $this->statuses()->save($lotStatus);
        }

        return $lotStatus;
    }

    /**
     * Cria um status dinâmico para uma reserva.
     *
     * @param Reservation $reservation
     * @return LotStatus
     */
    protected function createReservedStatus(Reservation $reservation)
    {
        return $this->createStatus(
            $reservation->user,
            LotStatusType::RESERVED,
            sprintf(
                'Lote reservado por %s, em %s. Data de encerramento: %s',
                $reservation->user->name,
                $reservation->init->format('d/m/Y H:i:s'),
                $reservation->due->format('d/m/Y H:i:s')
            ),
            false
        );
    }

    /**
     * Cria um status dinâmico para uma proposta.
     *
     * @param Proposal $proposal
     * @return LotStatus
     */
    protected function createProposedStatus(Proposal $proposal)
    {
        return $this->createStatus(
            $proposal->user,
            LotStatusType::PROPOSED,
            'Lote possui proposta ativa.',
            false
        );
    }

    /**
     * Retorna um status estático, ou seja, que está salvo na
     * tabela lot_statuses.
     *
     * Status do tipo Reservado e Proposta também constam
     * nessa tabela para efeito de histórico, mas como são
     * status dinâmicos, não devem ser retornados como status atual
     * do lote.
     *
     * @return LotStatus|object
     */
    protected function currentStaticStatus()
    {
        return $this->statuses()
            ->whereNotIn('type', [LotStatusType::RESERVED, LotStatusType::PROPOSED])
            ->latest()
            ->first();
    }

    /**
     * Determina se o lote está disponível.
     *
     * @return bool
     */
    public function isAvailable(): bool
    {
        return $this->latestStatus->type->value == LotStatusType::AVAILABLE;
    }
}
