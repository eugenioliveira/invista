<?php


namespace App\Actions\Address;


use App\Models\Person;
use Illuminate\Support\Facades\Validator;

class UpdatePersonAddress
{
    /**
     * Valida e atualiza o endereço da pessoa.
     *
     * @param Person $person
     * @param array $address
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Person $person, array $address)
    {
        $validated = Validator::make($address, [
            'street' => ['required', 'min:8'],
            'number' => ['required', 'numeric'],
            'apt_room' => ['nullable', 'min:3'],
            'neighbourhood' => ['required', 'min:5'],
            'city' => ['required', 'min:5'],
            'state' => ['required', 'min:2'],
            'postal_code' => ['required', 'numeric', 'digits:8'],
        ])->validate();

        $person->address->forceFill($validated);
        $person->address->save();
    }
}