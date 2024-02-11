<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\Review;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\ReviewRepositoryInterface;

class ReviewRepository extends BaseRepository implements ReviewRepositoryInterface
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        return ['rate'];
    }



    public function getMyGivenReviews($userId, $limit = 10)
    {
       $load = [
        'rate', 
        'reviewedUser',
        'ride' => function($q){
            $q->with(['origin', 'destination']);
        }
        ];
        return $this->model->where('user_id' , $userId)
        ->with($load)
        ->paginate($limit);

    }


    public function getMyReceivedReviews($userId, $limit = 10)
    {
       $load = [
        'rate',
        'user', 
        'ride' => function($q){
            $q->with(['origin', 'destination']);
        }
        ];
        return $this->model->where('reviewed_user_id' , $userId)
        ->with($load)
        ->paginate($limit);

    }


    
}