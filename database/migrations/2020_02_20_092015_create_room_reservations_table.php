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
            $table->unsignedBigInteger('price_id');
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
                    'end_date'=>'2020/05/09',
                    'price_id' =>'3'
                ],
                [
                    'reservation_id'=>'2',
                    'room_id'=>'2',
                    'starting_date'=>'2020/05/08',
                    'end_date'=>'2020/05/10',
                    'price_id' =>'7'

                ],
                [
                    'reservation_id'=>'3',
                    'room_id'=>'7',
                    'starting_date'=>'2020/05/09',
                    'end_date'=>'2020/05/10',
                    'price_id' =>'11'
                ],
                [
                    'reservation_id'=>'4',
                    'room_id'=>'1',
                    'starting_date'=>'2020/05/04',
                    'end_date'=>'2020/05/07',
                    'price_id' =>'14'
                ],
                [
                    'reservation_id'=>'5',
                    'room_id'=>'3',
                    'starting_date'=>'2020/05/08',
                    'end_date'=>'2020/05/10',
                    'price_id' =>'12'
                ],
                [
                    'reservation_id'=>'6',
                    'room_id'=>'4',
                    'starting_date'=>'2020/04/25',
                    'end_date'=>'2020/04/26',
                    'price_id' =>'29'
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
