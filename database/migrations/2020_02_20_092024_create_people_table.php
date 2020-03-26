<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('age_id');
            $table->unsignedInteger('number_of_persons');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('age_id')->references('id')->on('ages');
        });
        DB::table('people')->insert(
            [
                [
                    'reservation_id'=>1,
                    'age_id'=>'4',
                    'number_of_persons'=>'2'
                ],
                [
                    'reservation_id'=>2,
                    'age_id'=>'4',
                    'number_of_persons'=>'2'
                ],
                [
                    'reservation_id'=>3,
                    'age_id'=>'4',
                    'number_of_persons'=>'2'
                ],
                [
                    'reservation_id'=>3,
                    'age_id'=>'2',
                    'number_of_persons'=>'1'
                ],
                [
                    'reservation_id'=>4,
                    'age_id'=>'4',
                    'number_of_persons'=>'1'
                ],
                [
                    'reservation_id'=>5,
                    'age_id'=>'4',
                    'number_of_persons'=>'2'
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
        Schema::dropIfExists('people');
    }
}
