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


    public function getCities($filters, $limit = 10)
    {
        $cities = $this->model->query();
        $search = isset($filters['search']) ? $filters['search'] : '';
        $provinceId = (isset($filters['province_id']) && $filters['province_id']) ? $filters['province_id'] : null;
        if($provinceId){
            $cities = $cities->where('province_id', $provinceId);
        }

        $cities = $cities->where('name', 'like', '%'.$search.'%')
        ->with(['province'])->paginate($limit);

        return $cities;
    }

    
}