<?php

namespace App\Http\Livewire;

use App\Models\Allotment;
use Livewire\Component;
use Livewire\WithPagination;

class AllotmentList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.allotment-list', [
            'allotments' => Allotment::with(['lots', 'city'])->get()
        ]);
    }
}
