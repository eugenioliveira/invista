<?php

namespace Database\Seeders;

use App\Models\Allotment;
use App\Models\Lot;
use Illuminate\Database\Seeder;

class AllotmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Allotment::factory()
            ->times(10)
            ->hasLots(10)
            ->create();
    }
}
