<?php

namespace App\Http\Livewire;

use App\Models\Person;
use Livewire\Component;

class PersonDetailForm extends Component
{
    use RedirectHandler;

    /**
     * A pessoa que terá seus detalhes atualizados
     *
     * @var Person
     */
    public Person $person;


    public function render()
    {
        return view('livewire.person-detail-form');
    }
}
