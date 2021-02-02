<?php

namespace App\Http\Controllers;


use App\Models\Person;

class PersonAddressController extends Controller
{
    /**
     * Exibe um formulário de edição do endereço da pessoa
     *
     * @param Person $person
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Person $person)
    {
        return view('person.address', ['person' => $person]);
    }
}
