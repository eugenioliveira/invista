<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SalesGraphComponent extends Component
{
    public $graphData;

    public function getGraphData()
    {
        $this->graphData = json_encode([
            rand(0, 10),
            rand(2, 30),
            rand(20, 50),
            rand(0, 60),
            rand(0, 80),
            rand(0, 50),
            rand(0, 30),
            rand(0, 10),
            rand(0, 70),
            rand(0, 10),
            rand(0, 100),
            rand(0, 108)
        ]);
    }

    public function mount()
    {
        $this->getGraphData();
    }

    public function render()
    {
        return view('livewire.sales-graph-component');
    }
}
