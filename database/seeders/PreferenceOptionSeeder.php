<?php

namespace Database\Seeders;

use App\Models\Preference;
use App\Models\PreferenceOption;
use App\Models\ReportType;
use Illuminate\Database\Seeder;

class PreferenceOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(collect(PreferenceOption::all())->count() == 0){
            PreferenceOption::create([
                'preference_id' => Preference::where('name', 'music')->first()->id,
                'text' => 'با موزیک اوکی ام',
            ]);

            PreferenceOption::create([
                'preference_id' => Preference::where('name', 'music')->first()->id,
                'text' => 'با موزیک مشکل دارم',
            ]);

            PreferenceOption::create([
                'preference_id' => Preference::where('name', 'chat')->first()->id,
                'text' => 'هم صحبت خوبی هستم',
            ]);

            PreferenceOption::create([
                'preference_id' => Preference::where('name', 'chat')->first()->id,
                'text' => 'حوصله صحبت ندارم',
            ]);
       }
    }
}
