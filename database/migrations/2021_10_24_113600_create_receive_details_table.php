<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiveDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receive_details', function (Blueprint $table) {

            $table->bigInteger('receive_master_id')->unsigned();
            $table->bigInteger('counter')->unsigned();

            $table->bigInteger('buyer_id')->unsigned();
            $table->bigInteger('buyer_style_id')->unsigned();
            $table->bigInteger('garments_type_id')->unsigned();

            $table->bigInteger('unit_id')->unsigned();
            $table->bigInteger('received_total_quantity')->default(0);

            $table->bigInteger('grade_a')->default(0);
            $table->bigInteger('grade_b')->default(0);
            $table->bigInteger('grade_c')->default(0);
            $table->bigInteger('grade_d')->default(0);

            $table->date('qc_date')->nullable();
            $table->bigInteger('qc_c_quantity')->nullable();
            $table->bigInteger('qc_nc_quantity')->nullable();

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
        Schema::dropIfExists('receive_details');
    }
}
