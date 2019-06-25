<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('room_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('pricing_id')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('SET NULL');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('SET NULL');
            $table->foreign('pricing_id')->references('id')->on('pricings')->onDelete('SET NULL');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
