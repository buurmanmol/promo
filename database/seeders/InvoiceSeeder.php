<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
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
        Invoice::create([
            'name' =>  $faker->company,
            'factuur_id' => $faker->randomDigit,
            'aantal' => $faker->randomDigit,
            'omschrijving' => $faker->text,
            'bedrag'=> $faker->randomDigit,
            'user_id' => $faker->randomDigit,
            'company_id' => $faker->postcode
        ]);
        }
    }
}
