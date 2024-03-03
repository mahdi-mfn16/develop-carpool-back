<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\Direction;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\DirectionRepositoryInterface;

class DirectionRepository extends BaseRepository implements DirectionRepositoryInterface
{
    public function __construct(Direction $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        return [];
    }

    
}