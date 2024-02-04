<?php

namespace Database\Seeders;

use App\Models\Preference;
use App\Models\ReportType;
use Illuminate\Database\Seeder;

class PreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(collect(Preference::all())->count() == 0){
            Preference::create([
                'name' => 'music',
                'text' => 'موزیک',
            ]);
            Preference::create([
                'name' => 'chat',
                'text' => 'گفتگو',
            ]);
       }
    }
}
