<?php

namespace Database\Seeders;

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
        LotStatus::factory()->times(10)->create();
    }
}
