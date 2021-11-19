<?php

namespace App\Http\Controllers;

use App\Models\Lot;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Exibe uma listagem das reservas.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('reservations.index');
    }

    /**
     * Realiza uma reserva
     *
     * @param Lot $lot
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Lot $lot)
    {
        return view('reservations.create', ['lot' => $lot]);
    }

    /**
     * Cancelamento de uma reserva
     *
     * @param Reservation $reservation
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function cancel(Reservation $reservation)
    {
        if (
            $reservation->cancel(
                sprintf(
                    'Reserva cancelada manualmente por %s.',
                    \Auth::user()->name
                )
            )
        ) {
            return redirect()
                ->back()
                ->with('successMessage', 'Reserva cancelada com sucesso.');
        }
    }
}
