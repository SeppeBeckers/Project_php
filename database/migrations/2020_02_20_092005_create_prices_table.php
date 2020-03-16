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
            $table->unsignedBigInteger('occupancy_id');    // use SAME SIZE as id: unsignedInteger() creates an error!
            $table->unsignedBigInteger('accommodation_choice_id');    // use SAME SIZE as id: unsignedInteger() creates an error!
            $table->unsignedBigInteger('type_room_id');    // use SAME SIZE as id: unsignedInteger() creates an error!
            $table->double('price');
            $table->timestamp('from_date');
            $table->string('from_day')->nullable();
            $table->string('until_day')->nullable();
            $table->timestamps();

            // Foreign key relation
            $table->foreign('occupancy_id')->references('id')->on('occupancies');
            $table->foreign('accommodation_choice_id')->references('id')->on('accommodation_choices');
            $table->foreign('type_room_id')->references('id')->on('type_rooms');
        });
        DB::table('prices')->insert(
            [
                [
                    'occupancy_id' => '1',
                    'accommodation_choice_id'=>'2',
                    'type_room_id' => '1',
                    'price'=>'50',
                ],
                [
                    'occupancy_id' => '2',
                    'accommodation_choice_id'=>'1',
                    'type_room_id' => '2',
                    'price'=>'80',
                ],
                [
                    'occupancy_id' => '1',
                    'accommodation_choice_id'=>'4',
                    'type_room_id' => '1',
                    'price'=>'70',
                ],
                [
                    'occupancy_id' => '2',
                    'accommodation_choice_id'=>'3',
                    'type_room_id' => '1',
                    'price'=>'100',
                ],
                [
                    'occupancy_id' => '1',
                    'accommodation_choice_id'=>'1',
                    'type_room_id' => '2',
                    'price'=>'60'
                ],

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
