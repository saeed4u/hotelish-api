<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-29
 * Time: 14:38
 */

namespace App\Service;


use App\Booking;
use App\Http\Resources\BookingResource;
use App\Repo\BookingRepo;
use App\Room;
use App\User;
use App\Utils\ApiResponse;
use App\Utils\Logging;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class BookingService
{
    use ApiResponse, Logging;

    /**
     * @var BookingRepo
     */
    private $repo;

    /**
     * BookingService constructor.
     * @param BookingRepo $repo
     */
    public function __construct(BookingRepo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $bookings = Booking::paginate(15);
        return $this->success('Rooms retrieved', ['bookings' => BookingResource::collection($bookings)]);
    }

    /**
     * @param array $payload
     * @return \Illuminate\Http\JsonResponse
     */
    public function addBooking(array $payload)
    {
        try {
            $roomId = $payload['room_id'];
            $startDate = Carbon::parse($payload['start_date']);
            $endDate = Carbon::parse($payload['end_date']);

            //we check if end date is after or same as start date
            if ($startDate->gt($endDate)) {
                return $this->badRequest('Sorry your check out date can not be before your check in date');
            }

            $isThereABooking = $this->repo->doesBookingExist($roomId, $startDate, $endDate);

            if ($isThereABooking) {
                return $this->forbidden("Sorry, a booking is already available for the dates you selected");
            }

            /**
             * @var Collection $roomCol
             */
            $roomCol = $this->repo->read(Room::with('type.pricing')->whereKey($roomId));

            //valid because of validation in request
            /**
             * @var Room $room
             */
            $room = $roomCol->first();

            $pricing = $room->type->pricing;

            if ($pricing) {
                $diffInDays = $endDate->diffInDays($startDate);
                $booking = new Booking();
                $booking->room_id = $roomId;
                $booking->pricing_id = $pricing->id;
                $booking->start_date = $startDate;
                $booking->end_date = $endDate;
                $booking->total_nights = $diffInDays;
                $booking->total_price = $diffInDays * $pricing->price;

                if (isset($payload['user_id'])) {
                    $user = $this->repo->read(User::whereKey($payload['user_id']))->first();
                    $booking->customer_name = $user->name;
                    $booking->customer_email = $user->email;
                } else {
                    $booking->customer_name = $payload['name'];
                    $booking->customer_email = $payload['email'];
                }
                if ($this->repo->create($booking)) {
                    return $this->success('Booking has been created successfully',
                        ['booking' => new BookingResource($booking->refresh())]);
                }


            }

        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway('Sorry there was an error creating your booking, please try again later');
    }

    /**
     * @param Booking $booking
     * @param array $payload
     * @return \Illuminate\Http\JsonResponse
     */
    public function editBooking($booking, array $payload)
    {
        try {

            $roomId = $payload['room_id'];
            $startDate = Carbon::parse($payload['start_date']);
            $endDate = Carbon::parse($payload['end_date']);

            //we check if end date is after or same as start date
            if ($startDate->gt($endDate)) {
                return $this->badRequest('Sorry your check out date can not be before your check in date');
            }

            $isThereABooking = $this->repo->doesBookingExist($roomId, $startDate, $endDate);

            if ($isThereABooking) {
                return $this->forbidden("Sorry, a booking is already available for the dates you selected");
            }
            /**
             * @var Collection $roomCol
             */
            $roomCol = $this->repo->read(Room::with('type.pricing')->whereKey($roomId));

            //valid because of validation in request
            /**
             * @var Room $room
             */
            $room = $roomCol->first();

            $pricing = $room->type->pricing;
            if ($pricing) {
                $totalNights = $endDate->diffInDays($startDate);
                $totalPrice = $totalNights * $pricing->price;
                $payload['total_nights'] = $totalNights;
                $payload['total_price'] = $totalPrice;
                if (isset($payload['user_id'])) {
                    $user = $this->repo->read(User::whereKey($payload['user_id']))->first();
                    $payload['customer_name'] = $user->name;
                    $payload['customer_email'] = $user->email;
                }
                if ($this->repo->update($booking, $payload)) {
                    return $this->success('Booking has been updated successfully',
                        ['booking' => new BookingResource($booking->refresh())]);
                }
            }

        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();

    }

    /**
     * @param $booking
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteBooking($booking){
        try {
            if ($this->repo->delete($booking)) {
                return $this->success();
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

}