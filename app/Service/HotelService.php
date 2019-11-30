<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 14:23
 */

namespace App\Service;


use App\Hotel;
use App\HotelImage;
use App\Http\Resources\HotelResource;
use App\Repo\Hotel\HotelRepo;
use App\Repo\Repo;
use App\Utils\ApiResponse;
use App\Utils\Logging;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

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

    public function addHotel(array $payload)
    {
        $hotel = Hotel::create($payload);
        return $this->success('Hotel created', ['hotel' => new HotelResource($hotel)]);
    }

    public function getHotels()
    {
        try {
            $queryBuilder = Hotel::with(['country', 'rooms', 'images']);
            /**
             * @var Collection $hotelCollection
             */
            $hotelCollection = $this->repo->read($queryBuilder);
            return $this->success('Hotels retrieved successfully',
                ['hotels' => HotelResource::collection($hotelCollection)]);
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
            $hotel = $_REQUEST['hotel'];
            if ($this->repo->update($hotel, $payload)) {
                return $this->success('Hotel updated successfully', ['hotel' => $hotel->refresh()]);
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

    public function addHotelImage(UploadedFile $image)
    {
        try {

            $path = $image->store('public/hotel-images');
            $hotel = $_REQUEST['hotel'];
            $image = new HotelImage();
            $image->image = $path;
            $image->hotel_id = $hotel->id;
            if ($this->repo->create($image)) {
                return $this->success();
            }
        } catch (Exception $exception) {
            $this->logException($exception);
        }

        return $this->badGateway('An error while adding hotel image');

    }
}
