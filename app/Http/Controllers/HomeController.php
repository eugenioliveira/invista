<?php

namespace App\Http\Controllers;

use App\Models\Allotment;
use App\Models\Role;
use App\Models\User;
use Auth;

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
            'allotmentCount' => Allotment::count(),
            'brokersCount' => Role::firstWhere('name', '=', 'broker')
                ->users()
                ->count(),
            'usersCount' => User::count(),
            'reservationsCount' => Auth::user()->reservations()->active()->get()->count(),
            'proposalsCount' => Auth::user()->proposals()->active()->get()->count(),
        ]);
    }
}
