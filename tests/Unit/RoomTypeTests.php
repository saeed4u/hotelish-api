<?php
/**
 * Created by PhpStorm.
 * User: brasaeed
 * Date: 2019-06-26
 * Time: 15:16
 */

namespace Tests\Unit;


use App\RoomType;
use App\Service\RoomTypeService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class RoomTypeTests extends TestCase
{
    /**
     * @var RoomType
     */
    private $roomType;

    /**
     * @var RoomTypeService $service
     */
    private $service;

    public function testCreateRoomExpectSuccess()
    {
        $payload = [
            'name' => 'Room 1'
        ];
        $result = $this->service->addRoomType($payload);
        self::assertEquals(200, $result->status());
    }

    private function createRoomType()
    {
        $this->roomType = new RoomType();
        $this->roomType->name = 'Type 1';
        $this->roomType->save();
    }

    public function testGetRoomTypesExpectSuccess()
    {
        $this->createRoomType();
        $roomTypes = $this->service->getAll();
        $roomType = $roomTypes->getData()->room_types[0];
        self::assertEquals($this->roomType->id, $roomType->id);
        self::assertEquals($this->roomType->name, $roomType->name);
    }


    public function testUpDateRoom()
    {
        $this->createRoomType();
        $this->service->updateRoomType($this->roomType, ['name' => 'updated name']);
        $this->roomType = $this->roomType->refresh();
        self::assertEquals('updated name', $this->roomType->name);
    }

    public function testDeleteRoom()
    {
        $this->createRoomType();
        $this->service->deleteRoomType($this->roomType);
        $roomTypes = $this->service->getAll();
        self::assertEquals([], $roomTypes->getData()->room_types);
    }

    public function testCreateRoomExpectFailure()
    {
        $payload = [
            'id' => 'Room 1',
        ];
        $result = $this->service->addRoomType($payload);
        self::assertNotEquals(200, $result->status());
    }

    protected function setUp()
    {
        parent::setUp();
        $this->service = $this->app->make(RoomTypeService::class);
    }

    protected function tearDown()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('room_types')->truncate();
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}