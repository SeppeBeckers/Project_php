<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('accommodation_choice_id')->nullable();
            $table->unsignedBigInteger('occupancy_id');
            $table->unsignedBigInteger('arrangement_id')->nullable();
            $table->unsignedBigInteger('type_room_id');
            $table->double('amount');
            $table->timestamp('from_date');
            $table->timestamps();
            // Foreign key relation
            $table->foreign('occupancy_id')->references('id')->on('occupancies');
            $table->foreign('accommodation_choice_id')->references('id')->on('accommodation_choices');
            $table->foreign('type_room_id')->references('id')->on('type_rooms');
            $table->foreign('arrangement_id')->references('id')->on('arrangements')->onDelete('cascade')->onUpdate('cascade');

        });
        DB::table('prices')->insert(
            [
                [
                    'accommodation_choice_id'=>'1',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'amount'=>'47'
                ],
                [
                    'accommodation_choice_id'=>'1',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'amount'=>'49.5'
                ],
                [
                    'accommodation_choice_id'=>'1',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'amount'=>'34.5'
                ],
                [
                    'accommodation_choice_id'=>'1',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'amount'=>'36'
                ],
                [
                    'accommodation_choice_id'=>'2',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'amount'=>'87'
                ],
                [
                    'accommodation_choice_id'=>'2',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'amount'=>'89.5'
                ],
                [
                    'accommodation_choice_id'=>'2',
                    'occupancy_id' => '2',
                    'arrangement_id'=>null,
                    'type_room_id' => '1',
                    'amount'=>'74.5'
                ],
                [
                    'accommodation_choice_id'=>'2',
                    'occupancy_id' => '2',
                    'arrangement_id'=>null,
                    'type_room_id' => '2',
                    'amount'=>'76'
                ],
                [
                    'accommodation_choice_id'=>'3',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'amount'=>'74'
                ],
                [
                    'accommodation_choice_id'=>'3',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'amount'=>'76.5'
                ],
                [
                    'accommodation_choice_id'=>'3',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'amount'=>'61.5'
                ],
                [
                    'accommodation_choice_id'=>'3',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'amount'=>'63'
                ],
                [
                    'accommodation_choice_id'=>'4',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'amount'=>'90'
                ],
                [
                    'accommodation_choice_id'=>'4',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'amount'=>'92.5'
                ],
                [
                    'accommodation_choice_id'=>'4',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'amount'=>'77.5'
                ],
                [
                    'accommodation_choice_id'=>'4',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'amount'=>'80'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'2',
                    'type_room_id' => '1',
                    'amount'=>'161'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'2',
                    'type_room_id' => '2',
                    'amount'=>'166'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'2',
                    'type_room_id' => '1',
                    'amount'=>'136'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'2',
                    'type_room_id' => '2',
                    'amount'=>'139'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'3',
                    'type_room_id' => '1',
                    'amount'=>'181'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'3',
                    'type_room_id' => '2',
                    'amount'=>'186'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'3',
                    'type_room_id' => '1',
                    'amount'=>'156'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'3',
                    'type_room_id' => '2',
                    'amount'=>'159'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'4',
                    'type_room_id' => '1',
                    'amount'=>'309'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'4',
                    'type_room_id' => '2',
                    'amount'=>'319'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'4',
                    'type_room_id' => '1',
                    'amount'=>'259'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'4',
                    'type_room_id' => '2',
                    'amount'=>'265'
                ],
                [
                    'accommodation_choice_id'=>null,
                    'occupancy_id' => '1',
                    'arrangement_id'=> '1',
                    'type_room_id' => '1',
                    'amount'=>'87'
                ],
                [
                    'accommodation_choice_id'=>null,
                    'occupancy_id' => '1',
                    'arrangement_id'=> '1',
                    'type_room_id' => '2',
                    'amount'=>'89.5'
                ],
                [
                    'accommodation_choice_id'=>null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'1',
                    'type_room_id' => '1',
                    'amount'=>'74.5'
                ],
                [
                    'accommodation_choice_id'=>null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'1',
                    'type_room_id' => '2',
                    'amount'=>'76'
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
        Schema::dropIfExists('prices');
    }
}
