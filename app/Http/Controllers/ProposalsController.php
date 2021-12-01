<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Proposal;

class ProposalsController extends Controller
{
    public function index()
    {
        return view('proposals.index');
    }

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

    /**
     * Permite a edição de uma proposta com status Devolvida.
     *
     * @param Proposal $proposal
     */
    public function edit(Proposal $proposal)
    {
        return view('proposals.edit', ['proposal' => $proposal]);
    }
}
