<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Company::create([
                'name' => $faker->company,
                'address' => $faker->address,
                'postal_code' => $faker->postcode,
                'phone_number' => $faker->phoneNumber,
                'wallet' => 2000,
                'email' => $faker->email,
            ]);
        }
    }
}
