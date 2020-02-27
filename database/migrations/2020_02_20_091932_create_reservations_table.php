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
            $table->string('email');
            $table->string('phone_number');
            $table->string('address')->nullable();
            $table->string('place')->nullable();
            $table->string('gender');
            $table->string('note')->nullable();
            $table->unsignedInteger('deposit_amount')->nullable();
            $table->timestamps();

            // NO Foreign key relation
        });
        DB::table('reservations')->insert(
            [
                [
                    'name' => 'Van Thielen',
                    'first_name' => 'Jentse',
                    'email' => 'jentsevt@icloud.com',
                    'phone_number' => '0494843178',
                    'address' => 'Achterbist 48B',
                    'place' => 'Nijlen',
                    'gender' => 'Male'
                ],
                [
                'name' => 'Geerkens',
                'first_name' => 'Babette',
                'email' => 'babettegeerkens@gmail.com',
                'phone_number' => '0472712297',
                'address' => 'Velodroomstraat 59',
                'place' => 'Geel',
                'gender' => 'Female'
            ],[
                'name' => 'Vermeulen',
                'first_name' => 'Bram',
                'email' => 'brakke69@gmail.com',
                'phone_number' => '0412312369',
                'address' => 'Hooidonk 12',
                'place' => 'Grobbendonk',
                'gender' => 'Male'
            ],[
                'name' => 'Beckers',
                'first_name' => 'Seppe',
                'email' => 'seppebeckers@gmail.com',
                'phone_number' => '0123456789',
                'address' => 'Hoofdstraat 50',
                'place' => 'Eksel',
                'gender' => 'Male'
            ],[
                'name' => 'Vervecken',
                'first_name' => 'Brent',
                'email' => 'brentvervecken@gmail.com',
                'phone_number' => '0123412341',
                'address' => 'Donatusstraat 2',
                'place' => 'Hallaer',
                'gender' => 'Male'
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
        Schema::dropIfExists('reservations');
    }
}
