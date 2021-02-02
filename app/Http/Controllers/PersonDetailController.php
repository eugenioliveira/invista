<?php

namespace App\Http\Controllers;

use App\Models\Person;

class PersonDetailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Person $person
     * @return \Illuminate\Contracts\View\View
     */
    public function __invoke(Person $person)
    {
        return view('person.detail', ['person' => $person]);
    }
}
