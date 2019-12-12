<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
         $this->call(AdminUserSeeder::class);
        /*  $this->call(CountrySeeder::class);
          $this->call(HotelSeeder::class);
          $this->call(RoomTypeSeeder::class);
          $this->call(PricingSeeder::class);
          $this->call(RoomSeeder::class);*/
       // $this->call(BookingSeeder::class);
    }
}
