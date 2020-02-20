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
            $table->foreign('extra_cost_id')->references('id')->on('extra_costs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade')->onUpdate('cascade');
        });
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
