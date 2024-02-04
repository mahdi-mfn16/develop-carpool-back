<?php

namespace App\Repositories\Interfaces\Admin;


interface CityRepositoryInterface
{
    public function getCities($provinceId = null);
    
}