<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Core\File;
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
            'first_name' => 'Wouter',
            'last_name' => 'Moelker',
            'address' => 'Oppenheimstraat 37',
            'postal_code' => '9718LL',
            'phone_number' => '+31 6 31 67 33 18',
            'city' => 'Groningen',
            'role' => 'admin',
            'province' => 'Groningen',
            'email' => 'wouter.moelker@hotmail.com',
            'password' => bcrypt('123')
        ]);

        User::create([
            'first_name' => 'Thomas',
            'last_name' => 'Mol',
            'address' => 'Dwarsstraat 32',
            'postal_code' => '9123 LS',
            'phone_number' => '+31 6 31 67 23 18',
            'city' => 'Groningen',
            'role' => 'user',
            'province' => 'Groningen',
            'email' => 'th.molit@gmail.com',
            'password' => bcrypt('123')
        ]);


        $faker = \Faker\Factory::create();
        for($i = 0;$i < 10; $i++) {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'postal_code' => $faker->postcode,
                'city' => $faker->city,
                'phone_number' => $faker->phoneNumber,
                'province' => $faker->state,
                'email' => $faker->email,
                'password' => bcrypt('123'),
            ]);
        }
    }
}
