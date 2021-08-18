<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function create(Lot $lot)
    {
        return view('reservations.create', ['lot' => $lot]);
    }
}
