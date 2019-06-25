<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('room_type_id');
            $table->string('currency')->default('USD');
            $table->decimal('price')->default(0.00);
            $table->unsignedInteger('added_by')->nullable();
            $table->foreign('room_type_id')->references('id')->on('room_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('pricings');
    }
}
