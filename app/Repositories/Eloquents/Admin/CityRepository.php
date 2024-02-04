<?php 

namespace App\Repositories\Eloquents\Admin;

use App\Models\City;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\Admin\CityRepositoryInterface;

class CityRepository extends BaseRepository implements CityRepositoryInterface
{
    public function __construct(City $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        
    }


    public function getCities($provinceId = null)
    {
        $cities = $this->model->query();

        if($provinceId){
            $cities = $cities->where('province_id', $provinceId);
        }

        $cities = $cities->get();

        return $cities;
    }

    
}