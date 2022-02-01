<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiveImagesTable extends Migration
{
    /**
     * Run the migrations.
     *     * @return void
     */
    public function up()
    {
        Schema::create('receive_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('receive_master_id')->unsigned();
            $table->bigInteger('receive_detail_id')->unsigned();

            $table->text('image')->nullable();
            $table->bigInteger('counter')->unsigned();

            $table->bigInteger('inserted_by')->unsigned()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->nullable();
            $table->string('status', 4)->default('A');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receive_images');
    }
}
