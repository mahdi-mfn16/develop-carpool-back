<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\Payment;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\PaymentRepositoryInterface;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    public function __construct(Payment $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        
    }


    public function createManualPayment($request, $plan, $gateway)
    {
        $this->model->create([
            'user_id' => $request['user_id'],
            'plan_id' => $request['plan_id'],
            'payment_id' => null,
            'payment_code' => $request['payment_code'],
            'gateway_id' => $gateway['id'],
            'payment_amount' => $plan['payment_amount'],
            'plan_expired_at' => now()->addMonths($plan['period_time']),
            'destination_name' => $request['destination_name'],
            'destination_number' => $request['destination_number'],
            'origin_number' => $request['origin_number'],
            'file_id' => null,
            'description' => $request['description'],
            'payment_datetime' => $request['payment_date'].' '.$request['payment_time'],
            'is_confirmed' => 0
        ]);
    }



    public function confirmPayment($paymentId)
    {
        $payment = $this->model->where('id', $paymentId)->first();
        $payment->update([
            'is_cinfirmed' => 1
        ]);

        return $payment;
    }

    
}