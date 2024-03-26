<?php

namespace App\Repositories\Interfaces\User;


interface DirectionRepositoryInterface
{
   public function createDirection($ride, $direction);
   public function duplicateDirection($newRide, $ride);
}