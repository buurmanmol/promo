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
        $users = User::all();
        $faker = \Faker\Factory::create();

        foreach($users as $user){
        $company = Company::create([
           'name' =>  $faker->company,
            'address' => $faker->address,
            'postal_code' => $faker->postcode,
            'phone_number' => $faker->phoneNumber,
            'email' => $faker->email,
        ]);
        $company->users()->attach($user);
        }
    }
}
