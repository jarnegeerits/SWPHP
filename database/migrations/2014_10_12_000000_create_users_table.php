<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('linkId');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('admin');
        });

        Schema::create('cars', function(Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->integer('fuelCap');
            $table->integer('currentFuel');
            $table->integer('fuelUnit');
            $table->integer('currentPoss');
        });

        Schema::create('membership', function (Blueprint $table) {
            $table->id();
            $table->integer('carId');
            $table->integer('userId');
            $table->integer('debt');
            $table->integer('debtUnit');
            $table->integer('lastRefuelAmount');
            $table->date('lastRefuelDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
