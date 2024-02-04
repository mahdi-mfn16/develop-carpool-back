<?php

namespace App\Http\Controllers\Api\Admin;

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
        $payments = $this->paymentService->indexAllItems();
        return $this->successArrayResponse($payments);
    }






}
