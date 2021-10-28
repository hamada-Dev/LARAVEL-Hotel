<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_features', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('feature_id')->nullable()->unsigned();
            $table->integer('room_id')->nullable()->unsigned();

            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');     
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
        Schema::dropIfExists('room_features');
    }
}
