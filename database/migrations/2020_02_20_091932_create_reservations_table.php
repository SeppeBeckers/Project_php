<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('reservation_made_at');
            $table->boolean('with_deposit')->default(true);
            $table->string('name');
            $table->string('first_name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('address')->nullable();
            $table->string('residence')->nullable();
            $table->string('gender');
            $table->string('note')->nullable();
            $table->unsignedInteger('deposit_amount')->nullable();
            $table->timestamps();

            // NO Foreign key relation
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
