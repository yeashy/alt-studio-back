<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacemarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('placemarks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('latitude', 9, 6);
            $table->double('longitude', 9, 6);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('placemarks');
    }
}
