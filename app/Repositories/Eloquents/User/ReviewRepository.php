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
        
    }


    

    
}