<?php

namespace App\Actions\Person;

use App\Enums\CivilStatus;
use App\Models\Person;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Support\Facades\Validator;

class UpdatePersonDetail
{
    /**
     * Atualiza os detalhes da pessoa $person.
     *
     * @param Person $person
     * @param array $input
     * @param bool $persist
     * @return array|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Person $person, array $input)
    {
        $validated = $this->validate($input);

        if ($person->detail) {
            $person->detail->forceFill($validated);
            $person->detail->save();
        } else {
            $person->detail()->create($validated);
        }
    }

    public function validate($input): array
    {
        return Validator::make($input, [
            'civil_status' => [
                'required',
                new EnumValue(CivilStatus::class, false)
            ],
            'birth_date' => ['required', 'date_format:d/m/Y'],
            'birth_location' => ['required', 'min:5'],
            'nationality' => ['required', 'min:5'],
            'rg' => ['required', 'min:3'],
            'rg_issuer' => ['required', 'min:3'],
            'occupation' => ['required', 'min:5'],
            'email' => ['required', 'email:strict,dns,spoof'],
            'monthly_income' => [
                'required'
            ],
            'father_name' => ['required', 'min:5'],
            'mother_name' => ['required', 'min:5']
        ])
            //->sometimes('partner_id', ['required', 'numeric'], function ($input) {
            //return $input->civil_status == CivilStatus::MARRIED;
            //})
            ->validate();
    }
}
