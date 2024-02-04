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



     
}