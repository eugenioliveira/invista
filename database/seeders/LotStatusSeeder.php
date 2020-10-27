<?php

namespace Database\Seeders;

use App\Models\Lot;
use App\Models\LotStatus;
use Illuminate\Database\Seeder;

class LotStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Lot::all() as $lot) {
            LotStatus::factory()->create([
                'lot_id' => $lot->id
            ]);
        }
    }
}
