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

    public function createDirection($ride, $direction)
    {
        return $this->model->updateOrCreate(
            [
                'ride_id' => $ride['id']
            ],
            [
                'name' => $direction['name'],
                'route_index' => $direction['route_index'],
                'coordinates' => serialize($direction['coordinates']),
                'distance' => $direction['distance'],
                'time' => $direction['time'],
            ]
        );
    }
}