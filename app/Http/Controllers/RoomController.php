<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Service\RoomService;
use Illuminate\Http\Request;

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
        return $this->service->updateRoom($request->room, $validated);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoom(Request $request)
    {
        return $this->service->deleteRoom($request->room);
    }

}