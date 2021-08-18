<?php


namespace App\Actions\Lot;


use App\Enums\LotStatusType;
use App\Models\Lot;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CreateNewLotStatus
{
    /**
     * Cria um novo status para o Lote $lot.
     *
     * @param Lot $lot
     * @param array $input
     * @return \App\Models\LotStatus|\Illuminate\Database\Eloquent\Model
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Lot $lot, array $input)
    {
        $statusData = Validator::make($input, [
            'type' => ['required', new EnumValue(LotStatusType::class, false)],
            'reason' => ['required', 'min:8']
        ])->safe()->all();

        $statusData['user_id'] = Auth::user()->id;

        return $lot->statuses()->create($statusData);
    }
}