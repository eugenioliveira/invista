<?php

namespace App\View\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class SearchPagination extends Component
{
    /**
     * A collection para construir os links de paginação.
     *
     * @var LengthAwarePaginator
     */
    public LengthAwarePaginator $collection;

    /**
     * O placeholder para exibição no campo de busca.
     *
     * @var string
     */
    public string $searchPlaceholder;

    /**
     * Create a new component instance.
     *
     * @param LengthAwarePaginator $collection
     * @param string $searchPlaceholder
     */
    public function __construct(LengthAwarePaginator $collection, string $searchPlaceholder)
    {
        $this->collection = $collection;
        $this->searchPlaceholder = $searchPlaceholder;
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
