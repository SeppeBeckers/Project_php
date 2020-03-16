<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_costs', function (Blueprint $table) {
            $table->unsignedBigInteger('extra_cost_id');
            $table->unsignedBigInteger('bill_id');    // use SAME SIZE as id: unsignedInteger() creates an error!
            $table->double('amount');
            $table->timestamps();

            // Foreign key relation
            $table->foreign('extra_cost_id')->references('id')->on('extra_costs');
            $table->foreign('bill_id')->references('id')->on('bills');
        });

        DB::table('bill_costs')->insert(
            [
                [
                    'extra_cost_id'=>'1',
                    'bill_id'=>'1',
                    'amount'=>'20'
                ],
                [
                    'extra_cost_id'=>'2',
                    'bill_id'=>'2',
                    'amount'=>'30'
                ],
                [
                    'extra_cost_id'=>'3',
                    'bill_id'=>'3',
                    'amount'=>'45'
                ],
                [
                    'extra_cost_id'=>'4',
                    'bill_id'=>'4',
                    'amount'=>'10'
                ],
                [
                    'extra_cost_id'=>'3',
                    'bill_id'=>'5',
                    'amount'=>'85'
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
        Schema::dropIfExists('bill_costs');
    }
}
