<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddHotelRequest;
use App\Http\Requests\AddImageRequest;
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


    public function getHotels()
    {
        return $this->service->getHotels();
    }

    public function addHotel(AddHotelRequest $request)
    {
        return $this->service->addHotel($request->validated());
    }

    public function updateHotel(UpdateHotelRequest $request)
    {
        $validated = $request->validated();
        return $this->service->updateHotel($validated);
    }

    public function addHotelImage(AddImageRequest $request)
    {
        $request->validated();
        return $this->service->addHotelImage($request->file('image'));
    }
}
