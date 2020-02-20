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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('type_room_id');    // use SAME SIZE as id: unsignedInteger() creates an error!
            $table->unsignedInteger('room_number');
            $table->string('description')->nullable();
            $table->unsignedInteger('maximum_persons');
            $table->string('picture');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('type_room_id')->references('id')->on('type_rooms')->onDelete('cascade')->onUpdate('cascade');
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
