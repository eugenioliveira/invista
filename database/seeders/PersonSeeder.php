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
            'first_name' => 'Eugênio',
            'last_name' => 'Oliveira',
            'cpf' => '09864257617',
            'phone' => '35992533223'
        ])->saveUser('geninoliveira@gmail.com', 'e4.vrdrq');

        Person::create([
            'first_name' => 'Keith',
            'last_name' => 'Richards',
            'cpf' => '77852102093',
            'phone' => '35992533223'
        ])->saveUser('keith@gmail.com', 'e4.vrdrq');

        Person::create([
            'first_name' => 'Darth',
            'last_name' => 'Vader',
            'cpf' => '15133773021',
            'phone' => '35992533223'
        ])->saveUser('darth@gmail.com', 'e4.vrdrq');;
    }
}
