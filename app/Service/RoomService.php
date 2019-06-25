<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-25
 * Time: 23:38
 */

namespace App\Service;


use App\Hotel;
use App\Http\Resources\RoomResource;
use App\Room;

class RoomService extends CrudService
{
    /**
     * @param array $payload
     * @return \Illuminate\Http\JsonResponse
     */
    public function addRoom(array $payload)
    {
        try {
            $room = new Room();
            $room->name = $payload['name'];
            $room->room_type_id = $payload['room_type_id'];
            $room->added_by = auth()->id();
            $room->hotel_id = Hotel::first()->id;
            if ($this->repo->create($room)) {
                return $this->success('Room created successfully', ['room' => new RoomResource($room->refresh())]);
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

    /**
     * @param $roomId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoom($roomId)
    {
        return $this->success('Room retrieved', new RoomResource(Room::find($roomId)));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $rooms = Room::paginate(15);
        return $this->success('Rooms retrieved', ['rooms' => RoomResource::collection($rooms)]);
    }

    /**
     * @param Room $room
     * @param array $payload
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateRoom(Room $room, array $payload)
    {
        try {
            if ($this->repo->update($room, $payload)) {
                return $this->success('Room updated successfully', ['room' => new RoomResource($room->refresh())]);
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

    /**
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoom(Room $room)
    {
        try {
            if ($this->repo->delete($room)) {
                return $this->success();
            }
        } catch (\Exception $exception) {
            $this->logException($exception);
        }
        return $this->badGateway();
    }

}