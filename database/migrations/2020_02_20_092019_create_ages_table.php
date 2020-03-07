<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('age_category');
            $table->double('percentage_discount');
            $table->timestamps();

            // NO Foreign key relation
        });
        DB::table('ages')->insert(
            [
                [
                    'age_category'=>'0-3j',
                    'percentage_discount'=>'0.8',
                ],
                [
                    'age_category'=>'4-8j',
                    'percentage_discount'=>'0.5',
                ],
                [
                    'age_category'=>'9-12j',
                    'percentage_discount'=>'0.3',
                ],
                [
                    'age_category'=>'13+',
                    'percentage_discount'=>'0',
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
        Schema::dropIfExists('ages');
    }
}
