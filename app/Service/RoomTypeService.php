<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-26
 * Time: 01:05
 */

namespace App\Service;


use App\Http\Resources\RoomTypeResource;
use App\Repo\Repo;
use App\Room;
use App\RoomType;

class RoomTypeService extends CrudService
{
    /**
     * RoomService constructor.
     * @param Repo $repo
     */
    public function __construct(Repo $repo)
    {
        parent::__construct($repo);
    }

    /**
     * @param array $payload
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRoomType(array $payload)
    {
        try {
            $roomType = new RoomType();
            $roomType->name = $payload['name'];
            $roomType->added_by = auth()->id();
            if ($this->repo->create($roomType)) {
                return $this->success('Room Type created successfully', ['room_type' => new RoomTypeResource($roomType->refresh())]);
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

    /**
     * @param $roomTypeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoomType($roomTypeId)
    {
        return $this->success('Room type retrieved', new RoomTypeResource(Room::find($roomTypeId)));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $roomTypes = RoomType::paginate(15);
        return $this->success('Rooms retrieved', ['room_types' => RoomTypeResource::collection($roomTypes)]);
    }

    /**
     * @param RoomType $roomType
     * @param array $payload
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRoomType(RoomType $roomType, array $payload)
    {
        try {
            if ($this->repo->update($roomType, $payload)) {
                return $this->success('Room updated successfully', ['room' => new RoomTypeResource($roomType->refresh())]);
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

    /**
     * @param RoomType $roomType
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoomType(RoomType $roomType)
    {
        try {
            if ($this->repo->delete($roomType)) {
                return $this->success();
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }
}