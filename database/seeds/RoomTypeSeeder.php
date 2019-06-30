<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('room_types')->truncate();
        $roomTypes = [
            'Normal',
            'Executive',
            'Super Executive'
        ];
        foreach ($roomTypes as $roomType) {
            DB::table('room_types')->insert(['name' => $roomType]);
        }
    }
}
