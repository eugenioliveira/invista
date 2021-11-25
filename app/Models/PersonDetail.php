<?php

namespace App\Models;

use App\Casts\DecimalCast;
use App\Enums\CivilStatus;
use BenSampo\Enum\Traits\CastsEnums;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonDetail extends Model
{
    use HasFactory;
    use CastsEnums;

    protected $guarded = [];

    /**
     * Os atributos que devem ser convertidos.
     *
     * @var array
     */
    protected $casts = [
        'monthly_income' => DecimalCast::class . ':2',
        'birth_date' => 'date:d/m/Y',
        'civil_status' => CivilStatus::class
    ];

    /**
     * O detalhe pertence à uma pessoa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Retorna o cônjuge da pessoa, se houver.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function partner()
    {
        return $this->hasOne(Person::class, 'id', 'partner_id');
    }

    /**
     * Converte a data antes de salvar no banco
     *
     * @param $value
     */
    public function setBirthDateAttribute($value)
    {
        if ($value) {
            $this->attributes['birth_date'] = Carbon::createFromFormat('d/m/Y', $value);
        }
    }
}
