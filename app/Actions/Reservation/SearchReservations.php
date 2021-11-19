<?php

namespace App\Actions\Reservation;

use App\Models\Reservation;
use Carbon\Carbon;

class SearchReservations
{
    public function search($searchTerm, $filters, $sortField, $sortDirection, $onlyActive = true)
    {
        return Reservation::query()
            ->with(['lot', 'lot.allotment', 'user', 'reserveable'])
            ->when(\Str::length($searchTerm) >= 3, function ($query) use ($searchTerm) {
                $query
                    ->whereHas('lot.allotment', function ($query) use ($searchTerm) {
                        $query->where('title', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('reserveable', function ($query) use ($searchTerm) {
                        $query
                            ->where('first_name', 'like', "%{$searchTerm}%")
                            ->orWhere('last_name', 'like', "%{$searchTerm}%");
                    });
            })
            ->when($onlyActive, fn($query) => $query->active())
            ->when(
                $filters['init-min'],
                fn($query, $init) => $query->where('init', '>=', Carbon::createFromFormat('d/m/Y', $init)->startOfDay())
            )
            ->when(
                $filters['init-max'],
                fn($query, $init) => $query->where('init', '<=', Carbon::createFromFormat('d/m/Y', $init)->endOfDay())
            )
            ->when(
                $filters['due-min'],
                fn($query, $due) => $query->where('due', '>=', Carbon::createFromFormat('d/m/Y', $due)->startOfDay())
            )
            ->when(
                $filters['due-max'],
                fn($query, $due) => $query->where('due', '<=', Carbon::createFromFormat('d/m/Y', $due)->endOfDay())
            )
            ->orderBy($sortField, $sortDirection)
            ->paginate(8);
    }
}
