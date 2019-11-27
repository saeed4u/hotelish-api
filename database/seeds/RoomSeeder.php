<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->truncate();
        $rooms = [
            ['name' => 'A1', 'room_type_id' => 1],
            ['name' => 'A2', 'room_type_id' => 2],
            ['name' => 'A3', 'room_type_id' => 3],
            ['name' => 'A4', 'room_type_id' => 3],
            ['name' => 'B4', 'room_type_id' => 1],
            ['name' => 'B2', 'room_type_id' => 2],
            ['name' => 'B3', 'room_type_id' => 2],
            ['name' => 'C1', 'room_type_id' => 2],
            ['name' => 'D1', 'room_type_id' => 3],
            ['name' => 'D2', 'room_type_id' => 3],
            ['name' => 'D3', 'room_type_id' => 2],
        ];
        foreach ($rooms as $room) {
            DB::table('rooms')->insert(array_merge($room,['hotel_id'=>1]));
        }
    }
}
