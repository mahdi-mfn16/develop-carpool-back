<?php

namespace Database\Seeders;

use App\Models\Ride;
use App\Models\User;
use Illuminate\Database\Seeder;

class RideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ride::factory()
            ->count(20)
            ->create();
    }
}
