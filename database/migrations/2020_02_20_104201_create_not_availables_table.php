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
            $table->unsignedBigInteger('room_id');    // use SAME SIZE as id: unsignedInteger() creates an error!
            $table->date('starting_date');
            $table->date('end_date');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('room_id')->references('id')->on('rooms');
        });
        DB::table('not_availables')->insert(
            [
                'room_id'=>'1',
                'starting_date'=>'2020/04/10',
                'end_date'=>'2020/04/24'
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
