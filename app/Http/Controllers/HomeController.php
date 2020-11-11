<?php

namespace App\Http\Controllers;

use App\Models\Allotment;

class HomeController extends Controller
{
    /**
     * Exibe a página inicial do sistema, baseado no papel atual do usuário logado.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('home.index', [
            'allotmentCount' => Allotment::count()
        ]);
    }
}
