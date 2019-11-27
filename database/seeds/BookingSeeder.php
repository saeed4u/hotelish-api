<?php

use App\Room;
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

        $user = \App\User::find(2);

        for ($i = 1; $i <= 7; $i++) {
            $room = Room::with('type.pricing')->find($i);
            $totalNights = $startDate->diffInDays($endDate);
            $pricing = $room->type->pricing;
            $booking = [
                'room_id' => $i,
                'user_id' => $user->id,
                'pricing_id' => $pricing->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'total_nights' => $totalNights,
                'total_price' => $pricing->price * $totalNights,
                'customer_email' => $user->email,
                'customer_name' => $user->name,
            ];
            DB::table('bookings')->insert($booking);
        }

    }
}
