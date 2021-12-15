<?php

namespace App\Actions\Proposal;

use App\Models\Proposal;
use Carbon\Carbon;

class SearchProposals
{
    public function search(
        $searchTerm,
        $filters,
        $sortField,
        $sortDirection,
        $onlyActive = true,
        $lot = null,
        $proposal = null
    ) {
        $isBroker = \Auth::user()->hasRole('broker');
        $isSupervisor = \Auth::user()->hasRole('supervisor');
        return Proposal::query()
            ->with(['lot', 'lot.allotment', 'user', 'proposeable'])
            ->when(\Str::length($searchTerm) >= 3, function ($query) use ($searchTerm) {
                $query
                    ->whereHas('lot.allotment', function ($query) use ($searchTerm) {
                        $query->where('title', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', "%{$searchTerm}%");
                    })
                    ->orWhereHas('proposeable', function ($query) use ($searchTerm) {
                        $query
                            ->where('first_name', 'like', "%{$searchTerm}%")
                            ->orWhere('last_name', 'like', "%{$searchTerm}%");
                    });
            })
            ->when($onlyActive, fn($query) => $query->active())
            ->when(
                $filters['created-at-min'],
                fn($query, $init) => $query->where(
                    'created_at',
                    '>=',
                    Carbon::createFromFormat('d/m/Y', $init)->startOfDay()
                )
            )
            ->when(
                $filters['created-at-max'],
                fn($query, $init) => $query->where(
                    'created_at',
                    '<=',
                    Carbon::createFromFormat('d/m/Y', $init)->endOfDay()
                )
            )
            ->when($filters['type'], fn($query, $type) => $query->where('type', $type))
            ->when($isBroker, fn($query) => $query->where('user_id', \Auth::user()->id))
            ->when($isSupervisor, fn($query) => $query->whereIn('lot_id', \Auth::user()->allotments->map->lots->flatten()->pluck('id')))
            ->when($lot, fn($query, $lot) => $query->where('lot_id', $lot))
            ->when($proposal, fn($query, $proposal) => $query->where('id', $proposal))
            ->orderBy($sortField, $sortDirection)
            ->paginate(8);
    }
}
