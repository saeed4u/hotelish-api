<?php

use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hotel = new \App\Hotel();
        $hotel->name = 'Test hotel';
        $hotel->email = 'hotel@testhotel.com';
        $hotel->address = '1122 address';
        $hotel->city = 'Accra';
        $hotel->state = 'Greater Accra';
        $hotel->country_id = \App\Country::where('iso_code', 'GH')->first()->id;
        $hotel->zip_code = '00233';
        $hotel->phone_number = '+233502315886';
        $hotel->save();
    }
}
