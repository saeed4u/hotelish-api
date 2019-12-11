<?php

namespace App\Listeners;

use App\Device;
use App\Events\PushNotification;
use App\Utils\AppPushNotification;
use Illuminate\Support\Facades\Log;

class SendPushNotification extends AppPushNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PushNotification $event
     * @return void
     */
    public function handle(PushNotification $event)
    {
        $devices = Device::all(['fcm_token']);
        $devices->each(function (Device $device) use ($event) {
            $push = new \App\Utils\PushNotification();
            $push->title = $event->title;
            $push->message = $event->message;
            $push->tokens = collect($device->fcm_token);
            $this->sendPushNotification($push);
        });
    }

    function logProcess($message)
    {
        Log::channel('push')->info($message);
    }
}
