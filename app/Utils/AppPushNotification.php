<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-03-15
 * Time: 16:31
 */

namespace App\Utils;


abstract class AppPushNotification
{

    /**
     * @param PushNotification $notification
     */
    function sendPushNotification(PushNotification $notification): void
    {
        if ($notification->tokens->isEmpty()) {
            $this->logProcess("User device is empty, not sending push");
            return;
        }

        $devices = $notification->tokens->toArray();
        $push = new \Edujugon\PushNotification\PushNotification('fcm');

        $push->setConfig([
            'priority' => 'high',
            'dry_run' => false,
            'time_to_live' => 3,
        ]);

        $this->logProcess("Devices = " . json_encode($devices));
        $this->logProcess("FCM KEY = " . env('FCM_KEY'));
        $push->setApiKey(env('FCM_KEY',
            'AAAAKgnkVaQ:APA91bG_ewAQ6J9ygstrMbYwT8xvzMOj7nsrnnRVhtnJp4sFWOhqwd2l2lTXXTZI6YGw6Ks_IMMqMQxseiiSaIxwn3xRdMgoo1vqu2BZmLAB71pbZRM8uCnZViCBJL_JoFYndn087rZZ'));
        $push->setDevicesToken($devices);

        $msg = array(
            'data' => array(
                'title' => $notification->title,
                'type' => $notification->type,
                'desc' => $notification->message,
                'payload' => $notification->payload,
            ),
            'notification' => array(
                'title' => $notification->title,
                'body' => $notification->message,
                'type' => $notification->type
            )
        );
        $push->setMessage($msg);

        $this->logProcess('Sending push notification ' . json_encode($msg));

        $push->send();

        $this->logProcess('feedback ' . json_encode($push->getFeedback()));

        $this->logProcess('Unavailable devices ' . json_encode($push->getUnregisteredDeviceTokens()));
    }

    abstract function logProcess($message);

}
