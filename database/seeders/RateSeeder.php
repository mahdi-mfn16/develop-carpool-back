<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Rate;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       if(collect(Rate::all())->count() == 0){
            Rate::create([
                'rate' => 0,
                'text' => 'Very Bad',    
            ]);
            Rate::create([
                'rate' => 1,
                'text' => 'Bad',    
            ]);
            Rate::create([
                'rate' => 2,
                'text' => 'Not Bad',    
            ]);
            Rate::create([
                'rate' => 3,
                'text' => 'So So',    
            ]);
            Rate::create([
                'rate' => 4,
                'text' => 'Good',    
            ]);
            Rate::create([
                'rate' => 4,
                'text' => 'Very Good',    
            ]);
            
       }
    }
}
