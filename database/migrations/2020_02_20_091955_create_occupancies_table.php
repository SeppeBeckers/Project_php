<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupancies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('is_double');
            $table->timestamps();

            // NO Foreign key relation
        });
        DB::table('occupancies')->insert(
            [
                [
                    'is_double'=> false
                ],
                [
                    'is_double'=> true
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
        Schema::dropIfExists('occupancies');
    }
}
