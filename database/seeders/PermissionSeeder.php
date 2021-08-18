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
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('permission_role')->truncate();
        Permission::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Permission::create(['name' => 'view_allotments', 'description' => 'Permissão para listar todos os loteamentos.']);
        Permission::create(['name' => 'create_allotment', 'description' => 'Permissão para criar um novo loteamento no sistema.']);
        Permission::create(['name' => 'edit_allotment', 'description' => 'Permissão para alterar as informações de um loteamento.']);
        Permission::create(['name' => 'view_lots', 'description' => 'Permissão para listar todos os lotes de um loteamento.']);
        Permission::create(['name' => 'create_lots', 'description' => 'Permissão para criar um novo lote.']);
        Permission::create(['name' => 'edit_lot', 'description' => 'Permissão para alterar as informações de um lote.']);
        Permission::create(['name' => 'import_lots', 'description' => 'Permissão para importar lotes via excel.']);
        Permission::create(['name' => 'view_users', 'description' => 'Permissão para listar usuários do sistema.']);
        Permission::create(['name' => 'edit_user', 'description' => 'Permissão para editar um usuário do sistema.']);
        Permission::create(['name' => 'create_user', 'description' => 'Permissão para criar um usuário do sistema.']);
        Permission::create(['name' => 'view_people', 'description' => 'Permissão para listar as pessoas físicas cadastradas no sistema.']);
        Permission::create(['name' => 'create_person', 'description' => 'Permissão para criar uma pessoa física no sistema.']);
        Permission::create(['name' => 'view_companies', 'description' => 'Permissão para listar as pessoas jurídicas cadastradas no sistema.']);
        Permission::create(['name' => 'create_company', 'description' => 'Permissão para criar uma pessoa jurídica no sistema.']);
        Permission::create(['name' => 'make_reservation', 'description' => 'Permissão para reservar um lote no sistema.']);
    }
}
