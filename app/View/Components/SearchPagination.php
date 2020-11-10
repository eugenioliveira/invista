<?php

namespace App\View\Components;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;

class SearchPagination extends Component
{
    /**
     * @var mixed
     */
    public $links;

    /**
     * O placeholder para exibição no campo de busca.
     *
     * @var string
     */
    public string $searchPlaceholder;

    /**
     * Create a new component instance.
     *
     * @param $links
     * @param string $searchPlaceholder
     */
    public function __construct($links, string $searchPlaceholder)
    {
        $this->links = $links;
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
