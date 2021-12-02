<?php

namespace App\Actions\Sale;

use App\Models\Proposal;

class CreateNewSale
{
    /**
     * Cria uma nova venda no sistema.
     *
     * @param Proposal $proposal
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(Proposal $proposal)
    {
        return $proposal->sale()->create([
            'lot_id' => $proposal->lot_id,
            'user_id' => $proposal->user_id,
            'salable_id' => $proposal->proposeable_id,
            'salable_type' => $proposal->proposeable_type,
            'value' => $proposal->negotiated_value
        ]);
    }
}