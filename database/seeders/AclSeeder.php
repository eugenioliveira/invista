<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Atribui as permissões para o papel de supervisor.
         */
        Role::whereName('supervisor')->firstOrFail()
            ->allowTo('view_allotments')
            ->allowTo('view_lots')
            ->allowTo('view_users')
            ->allowTo('create_user')
            ->allowTo('create_person');
        //->allowTo('edit_user'); Rule handled by UserPolicy

        /**
         * Atribui as permissões para o papel de corretor.
         */
        Role::whereName('broker')->firstOrFail()
            ->allowTo('view_allotments')
            ->allowTo('view_lots')
            ->allowTo('create_person');

        // Atribui o papel de administrador para Eugenio
        User::whereName('Eugênio Oliveira')->firstOrFail()
            ->assignRole('admin');

        // Atribui o papel de supervisor para Keith
        User::whereName('Keith Richards')->firstOrFail()
            ->assignRole('supervisor');

        // Atribui o papel de corretor para Vader
        User::whereName('Darth Vader')->firstOrFail()
            ->assignRole('broker');
    }
}
