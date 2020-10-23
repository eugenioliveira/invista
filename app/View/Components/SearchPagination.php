<?php

namespace App\View\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class SearchPagination extends Component
{
    public LengthAwarePaginator $collection;

    /**
     * Create a new component instance.
     *
     * @param LengthAwarePaginator $collection
     */
    public function __construct(LengthAwarePaginator $collection)
    {
        $this->collection = $collection;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.search-pagination');
    }
}
