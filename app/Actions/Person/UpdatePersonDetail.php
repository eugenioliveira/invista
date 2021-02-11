<?php


namespace App\Actions\Person;


use App\Enums\CivilStatus;
use App\Models\Person;
use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdatePersonDetail
{
    /**
     * Atualiza os detalhes da pessoa $person.
     *
     * @param Person $person
     * @param array $input
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Person $person, array $input)
    {
        $validated = Validator::make($input, [
            'civil_status' => ['required', new EnumValue(CivilStatus::class, false)],
            'birth_date' => ['required', 'date_format:d/m/Y'],
            'birth_location' => ['required', 'min:5'],
            'nationality' => ['required', 'min:5'],
            'rg' => ['required', 'min:3'],
            'rg_issuer' => ['required', 'min:3'],
            'occupation' => ['required', 'min:5'],
            'email' => ['required', 'email:strict,dns,spoof'],
            'monthly_income' => ['required', 'regex:/^[1-9]\d*(\.\d{3})?(\,\d{1,2})?$/'],
            'father_name' => ['required', 'min:5'],
            'mother_name' => ['required', 'min:5'],
            'partner_id' => [
                Rule::requiredIf(function () use ($input) {
                    return $input['civil_status'] == CivilStatus::MARRIED;
                }),
                'nullable',
                'numeric'
            ]
        ])->validate();

        if ($person->detail) {
            $person->detail->forceFill($validated);
            $person->detail->save();
        } else {
            $person->detail()->create($validated);
        }
    }
}