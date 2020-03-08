<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_choices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->timestamps();

            // NO Foreign key relation
        });
        DB::table('accommodation_choices')->insert(
            [
                [
                    'type'=>'Kamer met ontbijt'
                ],
                [
                    'type'=>'Halfpension (4-gangenmenu)'
                ],
                [
                    'type'=>'Halfpension (3-gangenmenu)'
                ],
                [
                    'type'=>'Volpension (3-gangenmenu)'
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
        Schema::dropIfExists('accommodation_choices');
    }
}
