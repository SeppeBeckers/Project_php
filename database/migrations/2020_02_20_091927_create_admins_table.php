<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            // NO Foreign key relation
        });

        // Insert admin
        DB::table('admins')->insert(
            [
                [
                    'name' => 'admin',
                    'password' => Hash::make('admin1234'),
                    'created_at' => now()
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
        Schema::dropIfExists('admins');
    }
}
