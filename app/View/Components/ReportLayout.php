<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ReportLayout extends Component
{
    /**
     * O título da página
     *
     * @var string
     */
    public string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.report');
    }
}
