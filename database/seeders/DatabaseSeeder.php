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
            UserSeeder::class,
            CompanySeeder::class,
            InvoiceSeeder::class,
            PartSeeder::class,
            TechSeeder::class,
            DeviceSeeder::class,
            RepairSeeder::class,
        ]);
    }
}
