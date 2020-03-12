<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_costs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->double('percentage');
            $table->timestamps();

            // NO Foreign key relation
        });
        DB::table('extra_costs')->insert(
            [
                [
                    'type'=>'hond',
                    'percentage'=>'0.06'
                ],
                [
                    'type'=>'drank',
                    'percentage'=>'0.21'
                ],
                [
                    'type'=>'voeding',
                    'percentage'=>'0.12'
                ],
                [
                    'type'=>'zwembad',
                    'percentage'=>'0.06'
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
        Schema::dropIfExists('extra_costs');
    }
}
