<?php

namespace Database\Seeders;

use App\Models\Repair;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RepairSeeder extends Seeder
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
        foreach($users as $user) {
            Repair::create([
                'user_id' => $user->id,
                'device_id' => rand(1, 10),
                'product_type_id' => rand(1, 20),
                'company_id' => 2,
                'comment' => $faker->realText(60),
                'repair_date' => Carbon::now(),
                'manager_id' => 2,
            ]);
            Repair::create([
                'user_id' => $user->id,
                'device_id' => rand(1, 10),
                'product_type_id' => rand(1, 20),
                'comment' => $faker->realText(60),
                'repair_date' => Carbon::now(),
                'company_id' => 1,
                'manager_id' => 1,
            ]);
        }
    }
}
