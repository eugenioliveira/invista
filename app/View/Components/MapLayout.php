<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MapLayout extends Component
{
    /**
     * O título da página
     *
     * @var string
     */
    public string $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
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
        return view('layouts.map');
    }
}
