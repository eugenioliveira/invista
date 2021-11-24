<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination, WithSearch;

    public $brokers;

    protected $queryString = ['brokers'];

    public function render()
    {
        $usersQuery = User::where(function ($query) {
            $query
                ->where('name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
        })->when(
            $this->brokers,
            fn($query) => $query->whereHas('roles', fn($query) => $query->where('name', 'broker'))
        );

        /*
         * O usuário com papel de Supervisor
         * só poderá gerenciar Corretores.
         */
        if (\Auth::user()->isSupervisor()) {
            $usersQuery->whereHas('roles', function ($query) {
                $query->where('name', 'broker');
            });
        }

        return view('livewire.user-list', ['users' => $usersQuery->paginate(10)]);
    }
}
