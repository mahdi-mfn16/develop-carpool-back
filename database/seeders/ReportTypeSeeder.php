<?php

namespace Database\Seeders;

use App\Models\ReportType;
use Illuminate\Database\Seeder;

class ReportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(collect(ReportType::all())->count() == 0){
            ReportType::create([
                'name' => 'fake_user',
                'text' => 'یوزر فیک',
                'parent_id' => null
            ]);
            ReportType::create([
                'name' => 'bad_content',
                'text' => 'محتوای ممنوعه',
                'parent_id' => null
            ]);
            ReportType::create([
                'name' => 'bad_user',
                'text' => 'مزاحمت',
                'parent_id' => null
            ]);

            ReportType::create([
                'name' => 'sexual_content',
                'text' => 'بارگذاری محتوای جنسی توسط کاربر',
                'parent_id' => ReportType::where('name', 'bad_content')->first()->id
            ]);
       }
    }
}
