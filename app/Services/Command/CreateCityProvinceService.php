<?php

namespace App\Services\Command;

use App\Models\City;
use App\Models\Province;
use App\Repositories\Interfaces\Admin\CityRepositoryInterface;
use App\Repositories\Interfaces\Admin\ProvinceRepositoryInterface;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class CreateCityProvinceService extends BaseService
{
    public function __construct(
        private CityRepositoryInterface $cityRepo,
        private ProvinceRepositoryInterface $provinceRepo
    )
    {
        
    }


    public function createProvince()
    {
        
        try {
            $provinces = collect(json_decode(File::get(base_path('provinces.json'))));
            DB::beginTransaction();
            Province::getQuery()->delete();
            foreach($provinces as $province){
                Province::create([
                    'name' => $province->name
                ]);
            }
            DB::commit();
        } catch (Exception $th) {
            DB::rollBack();
            Log::info($th);
        }
       
       
    }


    public function createCity()
    {
       
        try {
            $provinces = collect(json_decode(File::get(base_path('provinces.json'))));
            $cities = collect(json_decode(File::get(base_path('cities.json'))));
            DB::beginTransaction();
            City::getQuery()->delete();
            foreach($cities as $city){
                $province = $provinces->where('id', $city->province_id)->first();
                $province = Province::where('name', $province->name)->first();
                City::create([
                    'name' => $city->name,
                    'province_id' => $province['id']
                ]);
            }
            DB::commit();
        } catch (Exception $th) {
            DB::rollBack();
            Log::info($th);
        }

        


    }

    
}