<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Eugênio Oliveira',
            'email' => 'geninoliveira@gmail.com',
            'password' => \Hash::make('e4.vrdrq')
        ]);
    }
}
