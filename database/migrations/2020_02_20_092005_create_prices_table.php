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
            $table->double('price');
            $table->timestamp('from_date');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('occupancy_id')->references('id')->on('occupancies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('accommodation_choice_id')->references('id')->on('accommodation_choices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_room_id')->references('id')->on('type_rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('arrangement_id')->references('id')->on('arrangements')->onDelete('cascade')->onUpdate('cascade');
        });
        DB::table('prices')->insert(
            [
                [
                    'accommodation_choice_id'=>'1',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'price'=>'47'
                ],
                [
                    'accommodation_choice_id'=>'1',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'price'=>'49.5'
                ],
                [
                    'accommodation_choice_id'=>'1',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'price'=>'34.5'
                ],
                [
                    'accommodation_choice_id'=>'1',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'price'=>'36'
                ],
                [
                    'accommodation_choice_id'=>'2',
                    'occupancy_id' => '1',
                    'arrangement_id'=> '1',
                    'type_room_id' => '1',
                    'price'=>'87'
                ],
                [
                    'accommodation_choice_id'=>'2',
                    'occupancy_id' => '1',
                    'arrangement_id'=> '1',
                    'type_room_id' => '2',
                    'price'=>'89.5'
                ],
                [
                    'accommodation_choice_id'=>'2',
                    'occupancy_id' => '2',
                    'arrangement_id'=>'1',
                    'type_room_id' => '1',
                    'price'=>'74.5'
                ],
                [
                    'accommodation_choice_id'=>'2',
                    'occupancy_id' => '2',
                    'arrangement_id'=>'1',
                    'type_room_id' => '2',
                    'price'=>'76'
                ],
                [
                    'accommodation_choice_id'=>'3',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'price'=>'74'
                ],
                [
                    'accommodation_choice_id'=>'3',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'price'=>'76.5'
                ],
                [
                    'accommodation_choice_id'=>'3',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'price'=>'61.5'
                ],
                [
                    'accommodation_choice_id'=>'3',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'price'=>'63'
                ],
                [
                    'accommodation_choice_id'=>'4',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'price'=>'90'
                ],
                [
                    'accommodation_choice_id'=>'4',
                    'occupancy_id' => '1',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'price'=>'92.5'
                ],
                [
                    'accommodation_choice_id'=>'4',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '1',
                    'price'=>'77.5'
                ],
                [
                    'accommodation_choice_id'=>'4',
                    'occupancy_id' => '2',
                    'arrangement_id'=> null,
                    'type_room_id' => '2',
                    'price'=>'80'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'2',
                    'type_room_id' => '1',
                    'price'=>'161'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'2',
                    'type_room_id' => '2',
                    'price'=>'166'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'2',
                    'type_room_id' => '1',
                    'price'=>'136'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'2',
                    'type_room_id' => '2',
                    'price'=>'139'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'3',
                    'type_room_id' => '1',
                    'price'=>'181'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'3',
                    'type_room_id' => '2',
                    'price'=>'186'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'3',
                    'type_room_id' => '1',
                    'price'=>'156'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'3',
                    'type_room_id' => '2',
                    'price'=>'159'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'4',
                    'type_room_id' => '1',
                    'price'=>'309'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '1',
                    'arrangement_id'=>'4',
                    'type_room_id' => '2',
                    'price'=>'319'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'4',
                    'type_room_id' => '1',
                    'price'=>'259'
                ],
                [
                    'accommodation_choice_id'=> null,
                    'occupancy_id' => '2',
                    'arrangement_id'=>'4',
                    'type_room_id' => '2',
                    'price'=>'265'
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
