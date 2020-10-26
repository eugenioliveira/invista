<?php

namespace App\Http\Controllers;
use App\Models\Allotment;

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
}
