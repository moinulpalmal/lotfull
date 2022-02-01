<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiveMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('receive_date');

            $table->string('receive_type', 2)->nullable();
            $table->string('reference_no', 150)->nullable();
            $table->bigInteger('receive_from')->unsigned();
            $table->bigInteger('location_id')->unsigned();

            $table->bigInteger('inserted_by')->unsigned()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->nullable();
            $table->string('status', 4)->default('A');

            $table->string('remarks', 255)->nullable();
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
        Schema::dropIfExists('receive_masters');
    }
}
