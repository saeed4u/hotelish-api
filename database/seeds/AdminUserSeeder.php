<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        $user = new \App\User();
        $user->first_name = 'Saeed';
        $user->last_name = 'Issah';
        $user->email = 'admin@codeline.com';
        $user->password = \Illuminate\Support\Facades\Hash::make('password1');
        $user->user_type = 'admin';
        $user->save();
    }
}
