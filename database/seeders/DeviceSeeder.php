<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach($users as $user) {
            Device::create([
                'user_id' => $user->id,
                'brands_models_id' => rand(1, 20),
            ]);
        }
    }
}
