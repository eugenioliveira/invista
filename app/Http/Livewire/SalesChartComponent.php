<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SalesChartComponent extends Component
{
    public function getChartData()
    {
        sleep(1);

        $chartData = [
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
            rand(10000, 90000) / rand(10, 20),
        ];

        $this->dispatchBrowserEvent('sales-chart-data-loaded', $chartData);
    }

    public function render()
    {
        return view('livewire.sales-chart-component');
    }
}
