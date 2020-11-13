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
        // Admin
        User::create([
            'name' => 'Eugênio Oliveira',
            'email' => 'geninoliveira@gmail.com',
            'password' => \Hash::make('e4.vrdrq'),
            'is_admin' => true
        ]);

        // Supervisor
        User::create([
            'name' => 'Keith Richards',
            'email' => 'keith@gmail.com',
            'password' => \Hash::make('e4.vrdrq'),
        ]);

        // Corretor
        User::create([
            'name' => 'Darth Vader',
            'email' => 'darthvader@empire.gov',
            'password' => \Hash::make('e4.vrdrq'),
        ]);
    }
}
