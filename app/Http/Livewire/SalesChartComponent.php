<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SalesChartComponent extends Component
{
    public $chartData;

    public function getChartData()
    {
        sleep(3);
        $this->chartData = [
            rand(1, 10),
            rand(2, 30),
            rand(20, 50),
            rand(1, 60),
            rand(1, 80),
            rand(1, 50),
            rand(1, 30),
            rand(1, 10),
            rand(1, 70),
            rand(1, 10),
            rand(1, 100),
            rand(1, 108)
        ];

        $this->dispatchBrowserEvent('sales-chart-data-loaded', $this->chartData);
    }

    public function render()
    {
        return view('livewire.sales-chart-component');
    }
}
