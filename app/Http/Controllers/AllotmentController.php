<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AllotmentController extends Controller
{
    /**
     * Lista os loteamentos.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('allotments.index');
    }
}
