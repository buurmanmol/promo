<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CompanySeeder::class,
            UserSeeder::class,
            InvoiceSeeder::class,
            PartSeeder::class,
            TechSeeder::class,
            DeviceSeeder::class,
            RepairSeeder::class,
        ]);
    }
}
