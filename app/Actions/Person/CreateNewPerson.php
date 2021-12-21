<?php


namespace App\Actions\Person;


use App\Models\Person;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateNewPerson
{
    /**
     * Valida e cria uma nova pessoa.
     *
     * @param array $input
     * @param bool $persist
     * @return Person
     */
    public function create(array $input, bool $persist = true): Person
    {
        $personData = $this->validate($input);

        $personData['creator_id'] = Auth::user()->id;

        return $persist ? Person::create($personData) : new Person($personData);
    }

    public function validate($input)
    {
        return Validator::make($input, [
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:2'],
            'cpf' => ['required', 'numeric', 'cpf', Rule::unique('people', 'cpf')],
            'phone' => ['required', 'regex:/^(\(?\d{2}\)?\s?)(\d{4,5}[\-\s]?\d{4})$/'],
        ])->validate();
    }
}