<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-29
 * Time: 14:28
 */

namespace App\Repo;


use App\Booking;
use App\Repo\Hotel\CrudRepoImpl;

class BookingRepoImpl extends CrudRepoImpl implements BookingRepo
{

    function doesBookingExist($roomId, $startDate, $endDate): bool
    {
        return Booking::where('room_id', $roomId)->whereDate('start_date', '>=',
            $startDate)->whereDate('end_date', '<=', $endDate)->exists();
    }
}