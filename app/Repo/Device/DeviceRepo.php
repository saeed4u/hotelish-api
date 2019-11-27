<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 24/03/2018
 * Time: 10:22 AM
 */

namespace App\Repository\Device;

use App\Device;
use App\Repo\Repo;

interface DeviceRepo extends Repo
{

    function findByIMEI($imei);

    function getPushRegistration($devID);

    function generateDevice(Device $device);

    function updateFcmToken($fcm_token);


}
