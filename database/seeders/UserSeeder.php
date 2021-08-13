<?php

namespace Database\Seeders;

use App\Models\Company;
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
        $companies = Company::all();
        User::create([
            'first_name' => 'Wouter',
            'last_name' => 'Moelker',
            'address' => 'Oppenheimstraat 37',
            'postal_code' => '9718LL',
            'phone_number' => '+31 6 31 67 33 18',
            'city' => 'Groningen',
            'role' => 'admin',
            'company_id' => 1,
            'manager_id' => 1,
            'province' => 'Groningen',
            'email' => 'wouter.moelker@hotmail.com',
            'password' => bcrypt('123'),
            'IBAN'=>bcrypt('NL55INGB1234567890'),
            'rek_houder'=>'W. Moelker',
        ]);

        User::create([
            'first_name' => 'Thomas',
            'last_name' => 'Mol',
            'address' => 'Dwarsstraat 32',
            'postal_code' => '9123 LS',
            'phone_number' => '+31 6 31 67 23 18',
            'city' => 'Groningen',
            'role' => 'manager',
            'manager_id' => 1,
            'province' => 'Groningen',
            'company_id' => 1,
            'email' => 'th.molit@gmail.com',
            'password' => bcrypt('123'),
            'IBAN'=>bcrypt('NL55INGB1234567891'),
            'rek_houder'=>'T. Mol',


        ]);

        User::create([
            'first_name' => 'Anton',
            'last_name' => 'Dolghanov',
            'address' => 'Wassenberhjstraat 32',
            'postal_code' => '9718 LS',
            'phone_number' => '+31 6 31 32 23 18',
            'city' => 'Groningen',
            'role' => 'user',
            'province' => 'Groningen',
            'manager_id' => 2,
            'company_id' => 1,
            'email' => 'adolganov@outlook.nl',
            'password' => bcrypt('123'),
            'IBAN'=>bcrypt('NL55INGB1234567892'),
            'rek_houder'=>'A. Dolganov',


        ]);

        User::create([
            'first_name' => 'Kevin',
            'last_name' => 'Houkema',
            'address' => 'Boeitmentweg 32',
            'postal_code' => '2222 LS',
            'phone_number' => '+31 63232 3232 ',
            'city' => 'Groningen',
            'role' => 'company',
            'province' => 'Groningen',
            'manager_id' => 2,
            'company_id' => 1,
            'email' => 'kevin-houkema@hotmail.com',
            'password' => bcrypt('123'),
            'IBAN'=>bcrypt('NL55INGB1234567893'),
            'rek_houder'=>'K. Houkema',

        ]);

        $faker = \Faker\Factory::create();
        foreach ($companies as $company) {
            $manager = User::create([
            'first_name' => $faker->firstName,
            'last_name' => $faker->lastName,
            'address' => $faker->address,
            'postal_code' => $faker->postcode,
            'city' => $faker->city,
            'company_id' => $company->id,
            'manager_id' => null,
            'role' => 'manager',
            'phone_number' => $faker->phoneNumber,
            'province' => $faker->state,
            'email' => $faker->email,
            'password' => bcrypt('123'),
                'IBAN'=> bcrypt($faker->bankAccountNumber),
                'rek_houder'=>$faker->lastName,

            ]);
            $manager->update([
                'manager_id' => $manager->id
            ]);
            $companyUser = User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'postal_code' => $faker->postcode,
                'city' => $faker->city,
                'company_id' => $company->id,
                'manager_id' => $manager->manager_id,
                'role' => 'company',
                'phone_number' => $faker->phoneNumber,
                'province' => $faker->state,
                'email' => $faker->email,
                'password' => bcrypt('123'),
                'IBAN'=> bcrypt($faker->bankAccountNumber),
                'rek_houder'=>$faker->lastName,

            ]);

            for ($i = 0; $i < 5; $i++) {


                User::create([
                    'first_name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'address' => $faker->address,
                    'postal_code' => $faker->postcode,
                    'city' => $faker->city,
                    'company_id' => $company->id,
                    'manager_id' => $manager->manager_id,
                    'role' => 'user',
                    'phone_number' => $faker->phoneNumber,
                    'province' => $faker->state,
                    'email' => $faker->email,
                    'password' => bcrypt('123'),
                    'IBAN'=> bcrypt($faker->bankAccountNumber),
                    'rek_houder'=>$faker->lastName,
                ]);
            }
        }
    }
}
