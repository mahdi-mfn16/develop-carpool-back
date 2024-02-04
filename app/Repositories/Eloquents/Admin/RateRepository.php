<?php 

namespace App\Repositories\Eloquents\Admin;

use App\Models\Rate;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\Admin\RateRepositoryInterface;

class RateRepository extends BaseRepository implements RateRepositoryInterface
{
    public function __construct(Rate $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        
    }

 

    
}