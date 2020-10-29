<?php

namespace App\Http\Controllers;
use App\Models\Allotment;
use App\Models\Lot;

class LotsController extends Controller
{
    /**
     * Exibe a lista de lotes do loteamento $allotment.
     *
     * @param Allotment $allotment
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Allotment $allotment)
    {
        return view('lots.index', [
            'allotment' => $allotment
        ]);
    }

    /**
     * Exibe um formulário para a criação de um lote.
     *
     * @param Allotment $allotment
     * @return \Illuminate\Contracts\View\View
     */
    public function create(Allotment $allotment)
    {
        return view('lots.create', [
            'allotment' => $allotment
        ]);
    }

    /**
     * Exibe um formulário para a edição de um lote.
     *
     * @param Lot $lot
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Lot $lot)
    {
        return view('lots.edit', [
            'lot' => $lot
        ]);
    }
}
