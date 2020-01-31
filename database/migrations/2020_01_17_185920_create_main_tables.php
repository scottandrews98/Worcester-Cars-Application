<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fuelType', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fuelTypeName');
        });

        Schema::create('bodyType', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bodyTypeName');
        });

        Schema::create('manufacturer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('manufacturerName');
        });

        Schema::create('transmission', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transmissionType');
        });

        Schema::create('carImages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('imageURL');
            $table->string('imageAltText');
        });

        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->double('price');
            $table->double('mileage');
            $table->string('engineSize');
            $table->integer('topSpeed');
            $table->double('tax');
            $table->string('mpg');
            $table->integer('totalDoors');
            $table->integer('totalSeats');

            $table->unsignedBigInteger('fuelType_id');
            $table->foreign('fuelType_id')->references('id')->on('fuelType');

            $table->unsignedBigInteger('bodyType_id');
            $table->foreign('bodyType_id')->references('id')->on('bodyType');

            $table->unsignedBigInteger('manufacturer_id');
            $table->foreign('manufacturer_id')->references('id')->on('manufacturer');

            $table->unsignedBigInteger('transmission_id');
            $table->foreign('transmission_id')->references('id')->on('transmission');
        });

        Schema::create('carsLiked', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('cars_id');
            $table->foreign('cars_id')->references('id')->on('cars');

            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
        });

        Schema::create('carImagesLink', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('cars_id');
            $table->foreign('cars_id')->references('id')->on('cars');

            $table->unsignedBigInteger('carImages_id');
            $table->foreign('carImages_id')->references('id')->on('carImages');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('userLevel_id');
            $table->foreign('userLevel_id')->references('id')->on('userLevel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_tables');
    }
}
