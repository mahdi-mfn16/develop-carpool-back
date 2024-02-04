<?php

namespace Database\Seeders;

use App\Models\NotificationType;
use Illuminate\Database\Seeder;

class NotificationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(collect(NotificationType::all())->count() == 0){
            NotificationType::create([
                'name' => 'chat',
                'text' => 'اعلانات گفتگو'
            ]);
           
            
            NotificationType::create([
                'name' => 'report',
                'text' => 'اعلان شکایات'
            ]);


            
       }
    }
}
