<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalInfoToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedInteger('total_nights');
            $table->decimal('total_price');
            //always USD
            $table->string('currency')->default('USD');
            $table->string('customer_email');
            $table->string('customer_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('total_nights');
            $table->dropColumn('total_price');
            $table->dropColumn('customer_email');
            $table->dropColumn('customer_name');
        });
    }
}
