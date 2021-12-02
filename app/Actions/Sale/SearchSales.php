<?php

namespace App\Actions\Sale;

use App\Models\Sale;

class SearchSales
{
    public function search($searchTerm, $sortField, $sortDirection, $proposal)
    {
        $isBroker = \Auth::user()->hasRole('broker');
        return Sale::query()
            ->with(['lot', 'lot.allotment', 'user', 'salable'])
            ->when(\Str::length($searchTerm) >= 3, function ($query) use ($searchTerm) {
                $query
                    ->whereHas('lot.allotment', function ($query) use ($searchTerm) {
                        $query->where('title', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('salable', function ($query) use ($searchTerm) {
                        $query
                            ->where('first_name', 'like', "%{$searchTerm}%")
                            ->orWhere('last_name', 'like', "%{$searchTerm}%");
                    });
            })
            ->when($isBroker, fn($query) => $query->where('user_id', \Auth::user()->id))
            ->when($proposal, fn($query, $proposal) => $query->where('id', $proposal))
            ->orderBy($sortField, $sortDirection)
            ->paginate(8)   ;
    }
}