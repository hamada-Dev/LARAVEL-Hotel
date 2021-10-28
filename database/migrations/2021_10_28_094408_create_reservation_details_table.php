<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_details', function (Blueprint $table) {
            $table->increments('id');

            $table->float('price')->nullable()->comment('price for reservations room ');
            $table->tinyInteger('person_number')->nullable()->comment('number of person stay in room');

            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();

            $table->integer('reservation_id')->nullable()->unsigned();
            $table->integer('room_id')->nullable()->unsigned();

            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');     
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');     
            
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
        Schema::dropIfExists('reservation_details');
    }
}
