<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cria os papéis iniciais da aplicação.
        Role::create(['name' => 'supervisor', 'label' => 'Supervisor']);
        Role::create(['name' => 'broker', 'label' => 'Corretor']);
    }
}
