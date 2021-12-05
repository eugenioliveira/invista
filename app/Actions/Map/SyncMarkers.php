<?php

namespace App\Actions\Map;

use App\Models\Map;

class SyncMarkers
{
    public function sync(Map $map)
    {
        $mapMarkersLotIds = $map->markers->pluck('lot_id');
        $lotsNotSynced = $map
            ->allotment
            ->lots()
            ->orderBy('block')
            ->orderBy('number')
            ->whereNotIn('id', $mapMarkersLotIds)
            ->get()
            ->chunk(50);
        $index = count($lotsNotSynced) - 1;
        $y = 1;
        while ($index >= 0) {
            $x = 1;
            foreach ($lotsNotSynced[$index] as $lot) {
                $map->markers()->create([
                    'lot_id' => $lot->id,
                    'position' => [$y * 20, $x * 20]
                ]);
                $x++;
            }
            $y++;
            $index--;
        }
    }
}