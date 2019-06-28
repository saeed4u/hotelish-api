<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomTypeRequest;
use App\Service\RoomTypeService;
use App\Utils\Logging;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    use Logging;
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
    public function getRoomTypes()
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
    public function addRoomType(RoomTypeRequest $request)
    {
        $validated = $request->validated();
        return $this->service->addRoomType($validated);
    }

    /**
     * @param RoomTypeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRoomType(RoomTypeRequest $request)
    {
        $validated = $request->validated();
        return $this->service->updateRoomType($_REQUEST['room-type'], $validated);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoomType()
    {
        $this->logAuth("Here ddd");
        return $this->service->deleteRoomType($_REQUEST['room-type']);
    }
}
