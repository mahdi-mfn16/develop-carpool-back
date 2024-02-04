<?php

namespace Database\Seeders;

use App\Models\StaticMessage;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(collect(Vehicle::all())->count() == 0){
            Vehicle::create([
                'name' => 'FORD',
            ]);

            Vehicle::create([
                'name' => 'BMW',
            ]);

            Vehicle::create([
                'name' => 'BENZ',
            ]);
           
       }
    }
}
