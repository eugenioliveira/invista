<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Person::create([
            'first_name' => 'Administrador',
            'last_name' => 'Intervest',
            'cpf' => '09864257617',
            'phone' => '35992533223'
        ])->saveUser('admin@intervest.imb.br', 'intervest@2021');

        Person::create([
            'first_name' => 'Supervisor',
            'last_name' => 'Intervest',
            'cpf' => '77852102093',
            'phone' => '35992533223'
        ])->saveUser('supervisor@intervest.imb.br', 'intervest@2021');

        Person::create([
            'first_name' => 'Corretor',
            'last_name' => 'Intervest',
            'cpf' => '15133773021',
            'phone' => '35992533223'
        ])->saveUser('corretor@intervest.imb.br', 'intervest@2021');

        Person::create([
            'first_name' => 'José',
            'last_name' => 'Mariano',
            'cpf' => '27909945019',
            'phone' => '35992533223'
        ]);
    }
}
