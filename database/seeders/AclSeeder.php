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
        Role::whereName('supervisor')
            ->firstOrFail()
            ->allowTo('view_allotments')
            ->allowTo('view_lots')
            ->allowTo('view_people')
            ->allowTo('create_person')
            ->allowTo('view_companies')
            ->allowTo('create_company')
            ->allowTo('view_reservations')
            ->allowTo('make_reservation')
            ->allowTo('propose')
            ->allowTo('view_proposals')
            ->allowTo('manage_proposals')
            ->allowTo('view_sales');

        /**
         * Atribui as permissões para o papel de corretor.
         */
        Role::whereName('broker')
            ->firstOrFail()
            ->allowTo('view_allotments')
            ->allowTo('view_lots')
            ->allowTo('view_people')
            ->allowTo('create_person')
            ->allowTo('view_companies')
            ->allowTo('create_company')
            ->allowTo('view_reservations')
            ->allowTo('make_reservation')
            ->allowTo('propose')
            ->allowTo('view_proposals')
            ->allowTo('view_sales');

        // Atribui o papel de administrador para Eugenio
        User::whereName('Eugênio Oliveira')
            ->firstOrFail()
            ->assignRole('admin');

        // Atribui o papel de supervisor para Keith
        User::whereName('Keith Richards')
            ->firstOrFail()
            ->assignRole('broker');

        // Atribui o papel de corretor para Vader
        User::whereName('Darth Vader')
            ->firstOrFail()
            ->assignRole('broker');
    }
}
