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
            $table->unsignedBigInteger('type_room_id');
            $table->unsignedInteger('room_number');
            $table->string('description')->nullable();
            $table->unsignedInteger('maximum_persons');
            $table->string('picture');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('type_room_id')->references('id')->on('type_rooms');
        });
        DB::table('rooms')->insert(
            [
                [
                    'room_number'=>'1',
                    'maximum_persons'=>'1',
                    'type_room_id'=>'1',
                    'description'=>'Eén enkel bed',
                    'picture'=>'kamer1.jpg'
                ],
                [
                    'room_number'=>'2',
                    'maximum_persons'=>'2',
                    'type_room_id'=>'1',
                    'description'=>'Twee enkel bedden',
                    'picture'=>'kamer2.jpg'
                ],
                [
                    'room_number'=>'3',
                    'maximum_persons'=>'2',
                    'type_room_id'=>'1',
                    'description'=>'Twee enkel bedden',
                    'picture'=>'kamer3.jpg'
                ],
                [
                    'room_number'=>4,
                    'maximum_persons'=>2,
                    'type_room_id'=>2,
                    'description'=>'Eén dubbel bed',
                    'picture'=>'kamer4.jpg'
                ],
                [
                    'room_number'=>5,
                    'maximum_persons'=>2,
                    'type_room_id'=>2,
                    'description'=>'Eén dubbel bed',
                    'picture'=>'kamer5.jpg'
                ],
                [
                    'room_number'=>6,
                    'maximum_persons'=>3,
                    'type_room_id'=>1,
                    'description'=>'Drie enkel bedden',
                    'picture'=>'kamer6.jpg'
                ],
                [
                    'room_number'=>7,
                    'maximum_persons'=>3,
                    'type_room_id'=>2,
                    'description'=>'Eén dubbel bed en één enkel bed',
                    'picture'=>'kamer7.jpg'
                ],
                [
                    'room_number'=>8,
                    'maximum_persons'=>4,
                    'type_room_id'=>1,
                    'description'=>'Vier enkel bedden',
                    'picture'=>'kamer8.jpg'
                ],
                [
                    'room_number'=>9,
                    'maximum_persons'=>4,
                    'type_room_id'=>2,
                    'description'=>'Eén dubbel bed en twee enkel bedden',
                    'picture'=>'kamer9.jpg'
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
        Schema::dropIfExists('rooms');
    }
}
