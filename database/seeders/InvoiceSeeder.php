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
            'invoice_path' => '/' . implode('/', $faker->words($faker->numberBetween(0, 4))),
            'payed' => $faker->boolean,
            'user_id' => $faker->randomDigit,
            'company_id' => $faker->postcode
          ]);
        }
    }
}
