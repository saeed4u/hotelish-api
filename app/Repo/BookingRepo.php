<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-29
 * Time: 14:26
 */

namespace App\Repo;


interface BookingRepo extends Repo
{
    function doesBookingExist($roomId, $startDate, $endDate): bool;
}