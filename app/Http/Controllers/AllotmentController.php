<?php

namespace App\Http\Controllers;

use App\Models\Allotment;
use Illuminate\Http\Request;

class AllotmentController extends Controller
{
    /**
     * Lista os loteamentos.
     *
     */
    public function index()
    {
        return view('allotments.index');
    }

    /**
     * Exibe um formulário que permite a criação de um novo
     * Loteamento.
     */
    public function create()
    {
        return view('allotments.create');
    }

    /**
     * Exibe um formulário que permite modificar os dados
     * de um loteamento.
     *
     * @param Allotment $allotment
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Allotment $allotment)
    {
        return view('allotments.edit', [
            'allotment' => $allotment
        ]);
    }
}
