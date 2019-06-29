<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddImageRequest;
use App\Http\Requests\AddRoomImageRequest;
use App\Http\Requests\RoomRequest;
use App\Service\RoomService;

class RoomController extends Controller
{
    /**
     * @var RoomService $service
     */
    private $service;

    /**
     * RoomController constructor.
     * @param RoomService $service
     */
    public function __construct(RoomService $service)
    {
        $this->service = $service;
        $this->logAuth("contructor");
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRooms()
    {
        return $this->service->getAll();
    }

    public function getRoom($id)
    {
        return $this->service->getRoom($id);
    }

    /**
     * @param RoomRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRoom(RoomRequest $request)
    {
        $this->logAuth("Here");
        $validated = $request->validated();
        return $this->service->addRoom($validated);
    }

    /**
     * @param RoomRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRoom(RoomRequest $request)
    {
        $validated = $request->validated();
        return $this->service->updateRoom($_REQUEST['room'], $validated);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoom()
    {
        return $this->service->deleteRoom($_REQUEST['room']);
    }

    public function addRoomImage(AddImageRequest $request)
    {
        $request->validated();
        return $this->service->addRoomImage($_REQUEST['room'], $request->file('image'));
    }

}
