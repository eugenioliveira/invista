<?php


namespace App\Actions\Lot;


use App\Models\Allotment;

class SearchLot
{
    /**
     * Realiza uma busca por um lote dentro do loteamento $allotment com a identificação $searchTerm
     *
     * @param Allotment $allotment
     * @param string $searchTerm
     * @param false $pagination
     * @return \App\Models\Lot[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\_LotCollection
     */
    public function search(Allotment $allotment, string $searchTerm, $pagination = false)
    {
        // Retorna o bloco do campo de pesquisa
        preg_match('/[A-Za-z]+/', $searchTerm, $block);
        // Retorna o número do campo de pesquisa
        preg_match('/\d+/', $searchTerm, $number);

        // Busca os lotes
        $lotQuery =  $allotment->lots()
            ->where(function ($query) use ($block, $number) {
                if ($block) $query->where('block', $block);
                if ($number) $query->where('number', $number);
            })
            ->orderBy('block')
            ->orderBy('number');

        return $pagination ? $lotQuery->paginate($pagination) : $lotQuery->get();
    }
}