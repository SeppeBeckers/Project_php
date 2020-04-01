<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotAvailablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('not_availables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('room_id');
            $table->date('starting_date');
            $table->date('end_date');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('room_id')->references('id')->on('rooms');
        });
        DB::table('not_availables')->insert(
            [
            [
                'room_id'=>'1',
                'starting_date'=>'2020/10/04',
                'end_date'=>'2020/10/24'
            ],
            [
                'room_id'=>'2',
                'starting_date'=>'2020/10/04',
                'end_date'=>'2020/10/24'
            ],
            [
                'room_id'=>'3',
                'starting_date'=>'2020/10/04',
                'end_date'=>'2020/10/24'
            ],
            [
                'room_id'=>'4',
                'starting_date'=>'2020/03/10',
                'end_date'=>'2020/05/30'
            ],
            [
                'room_id'=>'4',
                'starting_date'=>'2020/10/04',
                'end_date'=>'2020/10/24'
            ],
            [
                'room_id'=>'4',
                'starting_date'=>'2020/04/10',
                'end_date'=>'2020/04/11'
            ],
            [
                'room_id'=>'3',
                'starting_date'=>'2020/05/10',
                'end_date'=>'2020/05/12'
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
        Schema::dropIfExists('not_availables');
    }
}
