<?php

namespace App\Http\Controllers;

use App\Models\Person;

class PeopleController extends Controller
{
    /**
     * Exibe uma listagem de pessoas físicas cadastradas.
     */
    public function index()
    {
        return view('people.index');
    }

    /**
     * Exibe um formulário de cadastro de pessoa física.
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * Exibe um formulário de edição de pessoa física.
     * @param Person $person
     */
    public function edit(Person $person)
    {
        return view('people.edit', ['person' => $person]);
    }
}
