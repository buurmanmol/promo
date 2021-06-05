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
            'name' => 'Wouter',
            'email' => 'wouter.moelker@hotmail.com',
            'password' => bcrypt('123')
        ]);
    }
}
