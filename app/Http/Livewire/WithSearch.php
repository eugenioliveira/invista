<?php


namespace App\Http\Livewire;


trait WithSearch
{
    /**
     * Termo de busca.
     *
     * @var string
     */
    public string $searchTerm = '';

    /**
     * Redefine a páginação quando é realizada uma busca
     */
    public function updatingSearchTerm()
    {
        $this->resetPage();
    }
}