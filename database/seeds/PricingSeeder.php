<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PricingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('pricings')->truncate();
        $pricings = [
            ['room_type_id' => 1, 'price' => 1000],
            ['room_type_id' => 2, 'price' => 2000],
            ['room_type_id' => 3, 'price' => 3000],
        ];
        foreach ($pricings as $pricing) {
            DB::table('pricings')->insert($pricing);
        }
    }
}
