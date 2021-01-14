<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'firstname' => 'Eugênio',
            'lastname' => 'Oliveira',
            'cpf' => '09864257617',
            'phone' => '35992533223'
        ])->saveUser('geninoliveira@gmail.com', 'e4.vrdrq');

        Person::create([
            'firstname' => 'Keith',
            'lastname' => 'Richards',
            'cpf' => '77852102093',
            'phone' => '35992533223'
        ])->saveUser('keith@gmail.com', 'e4.vrdrq');

        Person::create([
            'firstname' => 'Darth',
            'lastname' => 'Vader',
            'cpf' => '77852102093',
            'phone' => '35992533223'
        ])->saveUser('darth@gmail.com', 'e4.vrdrq');;
    }
}
