<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddHotelImageRequest;
use App\Http\Requests\UpdateHotelRequest;
use App\Service\HotelService;

class HotelController extends Controller
{
    /** @var HotelService $service */
    private $service;

    /**
     * HotelController constructor.
     * @param HotelService $service
     */
    public function __construct(HotelService $service)
    {
        $this->service = $service;
    }


    public function getHotel()
    {
        return $this->service->getHotel();
    }

    public function updateHotel(UpdateHotelRequest $request)
    {
        $validated = $request->validated();
        return $this->service->updateHotel($validated);
    }

    public function addHotelImage(AddHotelImageRequest $request){
         $request->validated();
        return $this->service->addHotelImage($request->file('image'));
    }
}
