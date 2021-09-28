<?php

namespace App\Http\Controllers;

use App\Models\Lot;

class ProposalsController extends Controller
{
    /**
     * Cria uma proposta para o lote $lot.
     *
     * @param Lot $lot
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Lot $lot)
    {
        return view('proposals.create', ['lot' => $lot]);
    }
}
