<?php 

namespace App\Repositories\Eloquents\Admin;

use App\Models\Province;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\Admin\ProvinceRepositoryInterface;

class ProvinceRepository extends BaseRepository implements ProvinceRepositoryInterface
{
    public function __construct(Province $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        
    }

    
}