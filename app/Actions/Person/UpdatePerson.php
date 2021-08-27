<?php


namespace App\Actions\Person;


use App\Models\Person;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UpdatePerson
{
    /**
     * Atualiza as informações da pessoa $person.
     *
     * @param Person $person
     * @param array $input
     * @return void
     */
    public function update(Person $person, array $input): void
    {
        $validated = Validator::make($input, [
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:2'],
            'cpf' => ['required', 'numeric', 'cpf', Rule::unique('people', 'cpf')->ignore($person->id)],
            'phone' => ['required', 'regex:/^(\(?\d{2}\)?\s?)(\d{4,5}[\-\s]?\d{4})$/'],
        ])->validate();

        $person->forceFill($validated)->save();
        if ($person->user) {
            $person->user->name = $person->full_name;
            $person->user->save();
        }
    }
}