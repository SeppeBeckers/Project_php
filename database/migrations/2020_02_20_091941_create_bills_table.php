<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reservation_id');    // use SAME SIZE as id: unsignedInteger() creates an error!
            $table->timestamp('bill_made_at');
            $table->double('adjusted_amount')->nullable();
            $table->double('vat');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('reservation_id')->references('id')->on('reservations');
        });
        DB::table('bills')->insert(
            [
                [
                    'reservation_id' => '1',
                    'adjusted_amount' => '100',
                    'VAT'=>'21'
                ],
                [
                    'reservation_id' => '2',
                    'adjusted_amount' => '200',
                    'VAT'=>'42'
                ],
                [
                    'reservation_id' => '3',
                    'adjusted_amount' => '300',
                    'VAT'=>'63'
                ],
                [
                    'reservation_id' => '4',
                    'adjusted_amount' => '400',
                    'VAT'=>'84'
                ],
                [
                    'reservation_id' => '5',
                    'adjusted_amount' => '100',
                    'VAT'=>'105'
                ],

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
        Schema::dropIfExists('bills');
    }
}
