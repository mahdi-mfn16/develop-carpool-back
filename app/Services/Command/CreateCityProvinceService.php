<?php

namespace App\Services\Command;

use App\Classes\AddressDetail;
use App\Models\City;
use App\Models\Province;
use App\Models\Ride;
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
            Ride::getQuery()->delete();
            City::getQuery()->delete();
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
            Ride::getQuery()->delete();
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


    public function createProvinceBehzi()
    {
        
        try {
            $provinces = collect(json_decode(File::get(base_path('provinces_behzi.json'))))->sortBy('name')->values();
            DB::beginTransaction();
            Ride::getQuery()->delete();
            City::getQuery()->delete();
            Province::getQuery()->delete();
            foreach($provinces as $province){
                Province::create([
                    'name' => $province->name,
                    'lat' => $province->latitude,
                    'lng' => $province->longitude
                ]);
            }
            DB::commit();
        } catch (Exception $th) {
            DB::rollBack();
            Log::info($th);
        }
       
       
    }



    public function createCityBehzi()
    {
       
        try {
            $provinces = collect(json_decode(File::get(base_path('provinces_behzi.json'))));
            $cities = collect(json_decode(File::get(base_path('cities_behzi.json'))))->sortBy('name')->values();
            DB::beginTransaction();
            Ride::getQuery()->delete();
            City::getQuery()->delete();
            foreach($cities as $city){
                $province = $provinces->where('id', $city->state_id)->first();
                $province = Province::where('name', $province->name)->first();
                City::create([
                    'name' => $city->name,
                    'province_id' => $province['id'],
                    'lat' => $city->latitude,
                    'lng' => $city->longitude
                ]);
            }
            DB::commit();
        } catch (Exception $th) {
            DB::rollBack();
            Log::info($th);
        }

        


    }



    // update lat long


    public function updateProvinceDetails($chunk = null)
    {
        if($chunk){
            $provinces = Province::skip(($chunk-1)*100)->take(100)->get();
        }else{
            $provinces = Province::all();
        }
        
        try {
            DB::beginTransaction();
            
            foreach($provinces as $key=>$province){
                $info = AddressDetail::getAddressDetails($province);
                Log::info($key + 1);
                Log::info($info['name']);
                Log::info($info['lat']);
                Log::info($info['lon']);
                Log::info('------------------------');

                usleep(300000);

                $province->update([
                    'lat' => $info['lat'],
                    'lng' => $info['lon'],
                ]);
            }
            DB::commit();
        } catch (Exception $th) {
            DB::rollBack();
            Log::info($th);
        }
       
       
    }


    public function updateCityDetails($chunk = null)
    {
        if($chunk){
            $cities = City::skip(($chunk-1)*300)->take(300)->get();
        }else{
            $cities = City::all();
        }

        if(collect($cities)->count() == 0){
            return 'empty';
        }
        
        try {
            DB::beginTransaction();
            
            foreach($cities as $key=>$city){
                $info = AddressDetail::getAddressDetails($city);
                Log::info($key + 1);
                Log::info($city['name']);
                if($info){
                    Log::info($info['name']);
                    Log::info($info['lat']);
                    Log::info($info['lon']);
                }else{
                    Log::info('Error - No City');
                }
                
                Log::info('------------------------');

                usleep(100000);

                $city->update([
                    'lat' => $info['lat'],
                    'lng' => $info['lon'],
                    'bounding_box' => serialize($info['boundingbox']),
                ]);

            }
            DB::commit();
            return 'ok';
        } catch (Exception $th) {
            DB::rollBack();
            Log::info($th);
        }
       
       
    }

    
}