<?php

namespace App\Actions\User;

use App\Actions\Person\CreateNewPerson;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CreateNewUser
{
    /**
     * Classe responsável por criar uma nova pessoa.
     *
     * @var CreateNewPerson
     */
    private CreateNewPerson $personCreator;

    /**
     * Inicia o criador de usuários.
     *
     * @param CreateNewPerson $personCreator
     */
    public function __construct(CreateNewPerson $personCreator)
    {
        $this->personCreator = $personCreator;
    }

    /**
     * Valida e cria um usuário para a Pessoa $person.
     *
     * @param array $input
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(array $input)
    {
        $person = $this->personCreator->create($input, false);

        $validated = Validator::make($input, [
            'email' => ['required', 'email:strict,dns,spoof', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,id'],
            'creci' => ['nullable']
        ])->validate();

        $person->save();
        $user = $person->user()->create([
            'name' => $person->full_name,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'creci' => $validated['creci']
        ]);
        $user->assignRole($validated['role']);
        if ($validated['role'] != Role::ADMIN) {
            $user->allotments()->sync($input['selected_allotments']);
        }
    }
}
