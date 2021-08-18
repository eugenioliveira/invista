<?php


namespace App\Actions\Address;


use App\Models\Company;
use App\Models\Person;
use Illuminate\Support\Facades\Validator;

class UpdateAddress
{
    /**
     * Valida e atualiza o endereço da pessoa.
     *
     * @param Person|Company $addressable
     * @param array $address
     */
    public function update($addressable, array $address)
    {
        $validated = Validator::make($address, [
            'street' => ['required', 'min:8'],
            'number' => ['required', 'numeric'],
            'apt_room' => ['nullable', 'min:3'],
            'neighbourhood' => ['required', 'min:5'],
            'city' => ['required', 'min:5'],
            'state' => ['required', 'min:2'],
            'postal_code' => ['required', 'numeric', 'digits:8'],
        ])->safe()->all();

        if ($addressable->address) {
            $addressable->address->forceFill($validated);
            $addressable->address->save();
        } else {
            $addressable->address()->create($validated);
        }
    }
}