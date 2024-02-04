<?php

namespace Database\Seeders;

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
        // \App\Models\User::factory(10)->create();
        $this->call([
            ProvinceSeeder::class,
            CitySeeder::class,
            VehicleSeeder::class,
            PreferenceSeeder::class,
            PreferenceOptionSeeder::class,
            RateSeeder::class,
            // GatewaySeeder::class,
            NotificationTypeSeeder::class,
            ReportTypeSeeder::class,
            UserSeeder::class,
            FileSeeder::class,
            RideSeeder::class,

        ]);
        
    }
}
