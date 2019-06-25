<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 14:23
 */

namespace App\Service;


use App\Hotel;
use App\Http\Resources\HotelResource;
use App\Repo\Hotel\HotelRepo;
use App\Repo\Repo;
use App\Utils\ApiResponse;
use App\Utils\Logging;
use Illuminate\Database\Eloquent\Collection;

class HotelService
{
    use ApiResponse, Logging;
    /**
     * @var Repo $repo
     */
    private $repo;

    /**
     * HotelService constructor.
     * @param Repo $repo
     */
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }


    public function getHotel()
    {
        try {
            $queryBuilder = Hotel::with(['country', 'rooms', 'images']);
            /**
             * @var Collection $hotelCollection
             */
            $hotelCollection = $this->repo->read($queryBuilder);
            return $this->success('Hotel retrieved successfully',
                ['hotel' => new HotelResource($hotelCollection->first())]);
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badRequest();
    }

    public function updateHotel(array $payload)
    {
        try {
            /**
             * @var Hotel $hotel
             */
            $hotel = Hotel::first();
            if ($this->repo->update($hotel, $payload)) {
                return $this->success('Hotel updated successfully', ['hotel' => $hotel->refresh()]);
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }
}