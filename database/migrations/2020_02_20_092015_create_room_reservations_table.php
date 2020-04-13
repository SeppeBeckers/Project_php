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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('room_id');
            $table->date('starting_date');
            $table->date('end_date');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
        DB::table('room_reservations')->insert(
            [
                [
                    'reservation_id'=>'1',
                    'room_id'=>'5',
                    'starting_date'=>'2020/05/05',
                    'end_date'=>'2020/05/09'
                ],
                [
                    'reservation_id'=>'2',
                    'room_id'=>'2',
                    'starting_date'=>'2020/05/08',
                    'end_date'=>'2020/05/10'
                ],
                [
                    'reservation_id'=>'3',
                    'room_id'=>'7',
                    'starting_date'=>'2020/05/09',
                    'end_date'=>'2020/05/10'
                ],
                [
                    'reservation_id'=>'4',
                    'room_id'=>'1',
                    'starting_date'=>'2020/05/04',
                    'end_date'=>'2020/05/07'
                ],
                [
                    'reservation_id'=>'5',
                    'room_id'=>'3',
                    'starting_date'=>'2020/05/08',
                    'end_date'=>'2020/05/10'
                ],
                [
                    'reservation_id'=>'5',
                    'room_id'=>'9',
                    'starting_date'=>'2020/05/08',
                    'end_date'=>'2020/05/11'
                ]
            ]
        );
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
