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
            $table->unsignedInteger('price');
            $table->timestamp('from_date');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('occupancy_id')->references('id')->on('occupancys')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('accommodation_choice')->references('id')->on('accommodation_choices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_room_id')->references('id')->on('type_rooms')->onDelete('cascade')->onUpdate('cascade');
        });
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
