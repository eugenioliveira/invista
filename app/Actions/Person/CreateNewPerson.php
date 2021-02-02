<?php


namespace App\Actions\Person;


use App\Models\Person;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateNewPerson
{
    /**
     * Valida e cria uma nova pessoa.
     *
     * @param array $input
     * @return Person
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(array $input): Person
    {
        $validated = Validator::make($input, [
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:2'],
            'cpf' => ['required', 'numeric', 'cpf', Rule::unique('people', 'cpf')],
            'phone' => ['required', 'regex:/^(\(?\d{2}\)?\s?)(\d{4,5}[\-\s]?\d{4})$/'],
        ])->validate();

        return Person::create($validated);
    }
}