<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type_bath');
            $table->timestamps();

            // NO Foreign key relation
        });
        DB::table('type_rooms')->insert(
            [
                [
                    'type_bath'=>'Douche'
                ],
                [
                    'type_bath'=>'Douche/Bad'
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
        Schema::dropIfExists('type_rooms');
    }
}
