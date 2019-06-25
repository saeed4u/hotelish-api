<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomTypeRequest;
use App\Service\RoomTypeService;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    /**
     * @var RoomTypeService $service
     */
    private $service;

    /**
     * RoomController constructor.
     * @param RoomTypeService $service
     */
    public function __construct(RoomTypeService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoomsTypes()
    {
        return $this->service->getAll();
    }

    public function getRoomType($id)
    {
        return $this->service->getRoomType($id);
    }

    /**
     * @param RoomTypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRoom(RoomTypeRequest $request)
    {
        $validated = $request->validated();
        return $this->service->addRoomType($validated);
    }

    /**
     * @param RoomTypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRoom(RoomTypeRequest $request)
    {
        $validated = $request->validated();
        return $this->service->updateRoomType($request->room_type, $validated);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoomType(Request $request)
    {
        return $this->service->deleteRoomType($request->room_type);
    }
}
