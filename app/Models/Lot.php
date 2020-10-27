<?php

namespace App\Models;

use App\Casts\CurrencyCast;
use App\Casts\DecimalCast;
use App\Enums\LotStatusType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'price' => CurrencyCast::class,
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
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
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
            sprintf('%s metros de lado esquerdo com %s', $this->left, $this->left_side),
        ];
    }

    /**
     * Obtém o status atual do lote.
     *
     * @return LotStatus|object|null
     */
    public function getStatus()
    {
        /*
         * Este método deve retornar o status atual do lote.
         * Existem dois tipos de status no sistema:
         * - Estáticos, que são os status que não dependem de outras entidades
         * - Dinámicos, que depende de consultas à outras entidades.
         *
         * Os status Estáticos estão armazenados na tabela lot_statuses.
         *
         * Este método retornará o último registro da tabela lot_statuses se:
         * - Não houver nenhuma Reserva ativa para o lote atual;
         * - Não houver nenhuma Proposta que não foi finalizada para o lote atual;
         * - Não existir nenhuma Venda para o lote atual.
         *
         * Nos outros casos, deve retornar uma instância criada manualmente, porém, para
         * cada outro caso (Reserva, Proposta e Venda), para manutenção de um histórico,
         * cada finalização de ação deve ser registrada na tabela lot_statuses.
         *
         * O sistema deve de alguma forma se certificar de que o último status de um lote
         * na tabela lot_statuses não seja do tipo Reserva, Proposta ou Venda.
         *
         * Caso de uso: Reserva expirada
         * - Último registro de LotStatus: Reservado
         * - Sistema deve ignorar e buscar o pŕoximo.
         */

        // Verifica se o lote possui alguma reserva ativa
        $activeReservation = $this->hasActiveReservation();
        // caso haja, cria um Status do tipo reservado.
        if ($activeReservation) {
            return new LotStatus([
                'user_id' => $activeReservation->user_id,
                'type' => LotStatusType::RESERVED,
                'reason' => sprintf(
                    'Lote reservado por %s, em %s. Data de encerramento: %s',
                    $activeReservation->user->name,
                    $activeReservation->init->format('d/m/Y H:i:s'),
                    $activeReservation->due->format('d/m/Y H:i:s'),
                )
            ]);
        }

        return $this
            ->statuses()
            ->whereNotIn('type', [
                LotStatusType::RESERVED,
                LotStatusType::PROPOSED
            ])
            ->latest()
            ->first();
    }

    /**
     * Retorna a reserva ativa do lote caso exista
     *
     * @return Reservation
     */
    public function hasActiveReservation()
    {
        /*
         * Uma reserva está ativa quando a data atual
         * está entre a data de início e fim da reserva.
         */
        $reservations = $this
            ->reservations()
            ->where('init', '<=', now())
            ->where('due', '>=', now())
            ->get();

        if ($reservations->count() > 1) {
            throw new \UnexpectedValueException("Há mais de uma reserva ativa para o lote {$this->identification}. Verificar.");
        } else {
            return $reservations->first();
        }
    }
}
