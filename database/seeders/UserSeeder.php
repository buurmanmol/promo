<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
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

        $faker = \Faker\Factory::create();
        for($i = 0;$i < 10; $i++) {
            User::create([
                'name' =>  $faker->name,
                'email' => $faker->email,
                'password' => bcrypt('123'),
            ]);
        }
    }
}
