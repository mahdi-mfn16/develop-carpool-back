<?php

namespace App\Listeners;

use App\Events\SendRideApplyEvent;
use App\Services\User\ChatService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendRideApplyListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        private ChatService $chatService
    )
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendApplyEvent  $event
     * @return void
     */
    public function handle(SendRideApplyEvent $event)
    {
        $rideApply = $event->rideApply;

        $chat = $this->chatService->createItem(
            [
                'user_id_one' => $rideApply->user_id,
                'user_id_two' => $rideApply->ride->user_id,
                'ride_apply_id' => $rideApply->id,
            ]
        );
    }
}
