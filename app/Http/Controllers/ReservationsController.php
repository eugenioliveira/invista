<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function create(Lot $lot)
    {
        return view('reservations.create', ['lot' => $lot]);
    }

    public function cancel(Reservation $reservation)
    {
        if ($reservation->cancel(sprintf('Reserva cancelada manualmente por %s.', \Auth::user()->name))) {
            return redirect()->back()->with('successMessage', 'Reserva cancelada com sucesso.');
        }
    }
}
