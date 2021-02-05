<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PersonSeeder::class,
            CitySeeder::class,
            AllotmentSeeder::class,
            LotStatusSeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            AclSeeder::class,
            CompanySeeder::class
        ]);
    }
}
