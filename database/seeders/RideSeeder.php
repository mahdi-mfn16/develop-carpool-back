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
        if(collect(Ride::all())->count() != 0){
            Ride::getQuery()->delete();
        }

        Ride::factory()
            ->count(20)
            ->create();
    }
}
