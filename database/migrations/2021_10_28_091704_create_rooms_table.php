<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');

            $table->string('image')->nullable();

            $table->double('area')->nullable()->comment('The area of the room in meters');

            $table->tinyInteger('person_number')->nullable()->comment('number of person can stay in room');

            $table->float('room_price')->nullable()->comment('price for room if client reserve the whole room');
            $table->float('person_price')->nullable()->comment('price for clinet in room if room has many bed && clinet want one');
            
            
            $table->tinyInteger('status')->nullable()->comment('room status ( status == null ? avilable : have number of person resive ) ');


            $table->integer('branch_by')->nullable()->unsigned();
            $table->foreign('branch_by')->references('id')->on('branchs')->onDelete('cascade');
          
            $table->integer('type_by')->nullable()->unsigned();
            $table->foreign('type_by')->references('id')->on('types')->onDelete('cascade');
            
            $table->integer('added_by')->nullable()->unsigned();
            $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('rooms');
    }
}
