<?php

namespace App\Services\User;

use App\Events\SendUserNotificationEvent;
use App\Repositories\Interfaces\User\ReviewRepositoryInterface;
use App\Services\BaseService;

class ReviewService extends BaseService
{
    public function __construct(
        ReviewRepositoryInterface $reviewRepo
    )
    {
        parent::__construct($reviewRepo);
    }


    public function getAllReviews($request)
    {
        $limit = $request->input('limit') ?: 10;
        $filters = $request->input('filters');
        return $this->repository->getAllReviews($filters, $limit);

    }



    public function getMyReceivedReviews($request)
    {
        $userId = auth('sanctum')->id();
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getMyReceivedReviews($userId, $limit);

    }




    public function getMyGivenReviews($request)
    {
        $userId = auth('sanctum')->id();
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getMyGivenReviews($userId, $limit);

    }


    public function createReview($request, $ride)
    {
        $params = [
            'user_id' => auth('sanctum')->id(),
            'reviewed_user_id' => $request->input('reviewed_user_id'),
            'rate' => $request->input('rate'),
            'ride_id' => $ride['id'],
            'text' => $request->input('text')
        ];

        return $this->createItem($params);
    }


     
}