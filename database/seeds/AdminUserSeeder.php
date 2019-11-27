<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*  DB::table('users')->truncate();
        $user = new User();
        $user->first_name = 'Saeed';
        $user->last_name = 'Issah';
        $user->email = 'admin@codeline.com';
        $user->password = Hash::make('password1');
        $user->user_type = 'admin';
        $user->save();*/
        $user = new User();
        $user->first_name = 'Saeed';
        $user->last_name = 'Issah';
        $user->email = 'saeedissah@gmail.com';
        $user->password = Hash::make('password');
        $user->user_type = 'customer';
        $user->save();

    }
}
