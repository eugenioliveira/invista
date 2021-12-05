<?php

namespace App\Actions\Map;

use App\Models\Allotment;

class UpdateMap
{
    public function create(Allotment $allotment, array $input)
    {
        // Obtém as medidas da imagem de fundo
        $width = \Image::make(\Storage::disk('maps')->path($input['image']))->width();
        $height = \Image::make(\Storage::disk('maps')->path($input['image']))->height();
        $input['bounds'] = [[0,0], [$height, $width]];
        // Salva
        if ($allotment->map) {
            $allotment->map->forceFill($input);
            $allotment->map->save();
        } else {
            $allotment->map()->create($input);
        }
    }
}