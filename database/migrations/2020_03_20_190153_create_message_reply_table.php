<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageReplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_reply', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('messageReply');

            $table->unsignedBigInteger('contactFormSubmissions_id');
            $table->foreign('contactFormSubmissions_id')->references('id')->on('contactFormSubmissions');

            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('message_reply');
    }
}
