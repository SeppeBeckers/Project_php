<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrangementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrangements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('from_day')->nullable();
            $table->string('until_day')->nullable();
            $table->string('description');
            $table->timestamps();
        });
        DB::table('arrangements')->insert(
            [
                [
                    'type'=>'Kort weekend',
                    'from_day'=>'zaterdag',
                    'until_day'=>'zondag',
                    'description'=>'Eén overnachting met ontbijt, één 4-gangenmenu (zaterdagnamiddag tot zondagmorgen).'
                ],
                [
                    'type'=>'Lang weekend',
                    'from_day'=>'vrijdag',
                    'until_day'=>'zondag',
                    'description'=>'Twee overnachtingen met ontbijt, één 3-gangenmenu op vrijdag en één 4-gangenmenu op zaterdag (vrijdagnamiddag tot zondagmorgen).'
                ],
                [
                    'type'=>'Fietsweekend',
                    'from_day'=>'vrijdag',
                    'until_day'=>'zondag',
                    'description'=>'Twee overnachtingen met ontbijt, één 4-gangenmenu, één 3-gangenmenu twee lunchpakketen (vrijdagnamiddag tot zondagmorgen).'
                ],
                [
                    'type'=>'Midweek',
                    'from_day'=>'maandag',
                    'until_day'=>'vrijdag',
                    'description'=>'Vier overnachtingen met ontbijt, één 4-gangenmenu en drie 3-gangenmenu\'s (maandag tot vrijdag).'
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
        Schema::dropIfExists('arrangements');
    }
}
