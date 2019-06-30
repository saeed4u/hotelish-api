<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bookings')->truncate();
        $startDate = now();
        $endDate = now()->addDays(7);

        for ($i = 1; $i <= 10; $i++) {
            $room = \App\Room::with('type.pricing')->find($i);
            $totalNights = $startDate->diffInDays($endDate);
            $pricing = $room->type->pricing;
            $booking = [
                'room_id' => $i,
                'pricing_id' => $pricing->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_nights' => $totalNights,
                'total_price' => $pricing->price * $totalNights,
                'customer_email' => "customer $i",
                'customer_name' => "customer_$i@gmail.com",
            ];
            DB::table('bookings')->insert($booking);
        }

    }
}
