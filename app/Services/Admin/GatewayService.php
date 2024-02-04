<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\GatewayRepositoryInterface;
use App\Services\BaseService;

class GatewayService extends BaseService
{
    public function __construct(
        GatewayRepositoryInterface $gatewayRepo
    )
    {
        parent::__construct($gatewayRepo);
    }

    
}