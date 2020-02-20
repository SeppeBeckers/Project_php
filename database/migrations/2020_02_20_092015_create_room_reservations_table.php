<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_reservations', function (Blueprint $table) {
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('room_id');    // use SAME SIZE as id: unsignedInteger() creates an error!
            $table->date('starting_date');
            $table->date('end_date');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_reservations');
    }
}
