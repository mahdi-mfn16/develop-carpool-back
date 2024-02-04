<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\ManualPaymentRequest;
use App\Http\Requests\Payment\SetPaymentRequest;
use App\Http\Requests\Payment\VerifyPaymentRequest;
use App\Models\Payment;
use App\Services\User\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct(
        private PaymentService $paymentService
    ){}



    /**
     * Display a listing of the payments.
     *
     */
    public function getPaymentList()
    {
        $userId = auth('sanctum')->id();
        $payments = $this->paymentService->getPaymentList($userId);
        return $this->successArrayResponse($payments);
    }


    /**
     * Display a listing of the plans.
     *
     */
    // public function getPlanList()
    // {
    //     $plans = $this->planService->indexAllItems();
    //     return $this->successArrayResponse($plans);
    // }



    /**
     * show the specified payment.
     *
     */
    public function showPayment(Payment $payment)
    {
        $payment = $this->paymentService->showItem($payment['id']);
        return $this->successJsonResponse($payment);
    }



    /**
     * set a payment and send to gateway
     *
     */
    public function setPayment(SetPaymentRequest $request)
    {
        //
    }


    /**
     * verify payment after gateway
     *
     */
    public function verifyPayment(VerifyPaymentRequest $request)
    {
        //
    }



    /**
     * get manual payment reciept
     *
     */
    public function storeManualPayment(ManualPaymentRequest $request)
    {
        $request['user_id'] = auth('sanctum')->id();
        $payment = $this->paymentService->storeManualPayment($request);
        return $this->successJsonResponse($payment);
    }


    






}
