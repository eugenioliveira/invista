<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Cria as permissões iniciais da aplicação.
         * IMPORTANTE: este arquivo deve ser atualizado a cada
         * nova funcionalidade criada.
         */
        Permission::create(['name' => 'view_allotments', 'description' => 'Permissão para listar todos os loteamentos.']);
        Permission::create(['name' => 'create_allotment', 'description' => 'Permissão para criar um novo loteamento no sistema.']);
        Permission::create(['name' => 'edit_allotment', 'description' => 'Permissão para alterar as informações de um loteamento.']);
        Permission::create(['name' => 'view_lots', 'description' => 'Permissão para listar todos os lotes de um loteamento.']);
        Permission::create(['name' => 'create_lots', 'description' => 'Permissão para criar um novo lote.']);
        Permission::create(['name' => 'edit_lot', 'description' => 'Permissão para alterar as informações de um lote.']);
        Permission::create(['name' => 'import_lots', 'description' => 'Permissão para importar lotes via excel.']);
    }
}
