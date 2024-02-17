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
        return [
            // 'rate'
        ];
    }


    public function getAllReviews($filters, $limit = 10)
    {
        $load = [
            // 'rate',
            'user',
            'reviewedUser',
        ];
        $reviews = $this->model->query();
        $search = isset($filters['search']) ? $filters['search'] : '';
        $status = (isset($filters['status']) && $filters['status']) ? $filters['status'] : null;

        if($status){
            $reviews = $reviews->where('status', $status);
        }

        $reviews = $reviews->where('name', 'like', '%'.$search.'%')
        ->with($load)->paginate($limit);

        return $reviews;
    }



    public function getMyGivenReviews($userId, $limit = 10)
    {
       $load = [
        // 'rate', 
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
        // 'rate',
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