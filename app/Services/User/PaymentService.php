<?php

namespace App\Services\User;

use App\Repositories\Interfaces\Admin\GatewayRepositoryInterface;
use App\Repositories\Interfaces\Admin\PlanRepositoryInterface;
use App\Repositories\Interfaces\User\PaymentRepositoryInterface;
use App\Services\BaseService;

class PaymentService extends BaseService
{
    public function __construct(
        PaymentRepositoryInterface $paymentRepo,
        private GatewayRepositoryInterface $gatewayRepo
    )
    {
        parent::__construct($paymentRepo);
    }


    public function getPaymentList($userId)
    {
        return $this->repository->findWithConditions(['user_id' => $userId]);
    }



    public function storeManualPayment($request)
    {
        // $plan = $this->planRepo->getPlanInfo($request['plan_id']);
        // $gateway = $this->gatewayRepo->getGateway('card');
        // return $this->repository->createManualPayment($request, $plan, $gateway);
    }



    public function setPayment()
    {
        
    }

    

    public function verifyPayment()
    {
        
    }


 
     
}