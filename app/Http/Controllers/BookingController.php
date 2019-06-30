<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-29
 * Time: 23:36
 */

namespace App\Http\Controllers;


use App\Http\Requests\BookingRequest;
use App\Service\BookingService;

class BookingController extends Controller
{
    /**
     * @var BookingService $service
     */
    private $service;

    /**
     * BookingController constructor.
     * @param BookingService $service
     */
    public function __construct(BookingService $service)
    {
        $this->service = $service;
    }


    public function getBookings()
    {
        return $this->service->getAll();
    }

    public function addBooking(BookingRequest $bookingRequest)
    {
        return $this->service->addBooking($bookingRequest->validated());
    }

    public function updateBooking(BookingRequest $bookingRequest)
    {
        return $this->service->editBooking($_REQUEST['booking'], $bookingRequest->validated());
    }

    public function deleteBooking()
    {
        return $this->service->deleteBooking($_REQUEST['booking']);
    }

}