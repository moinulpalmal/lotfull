<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigInteger('receive_master_id')->unsigned();
            $table->bigInteger('receive_detail_id')->unsigned();
            $table->date('receive_date')->nullable();
            $table->date('stock_entry_date')->nullable();

            $table->bigInteger('unit_id')->unsigned();
            $table->bigInteger('received_total_quantity')->default(0);

            $table->bigInteger('grade_a')->default(0);
            $table->bigInteger('grade_b')->default(0);
            $table->bigInteger('grade_c')->default(0);
            $table->bigInteger('grade_d')->default(0);

            $table->bigInteger('issued_grade_a')->default(0);
            $table->bigInteger('issued_grade_b')->default(0);
            $table->bigInteger('issued_grade_c')->default(0);
            $table->bigInteger('issued_grade_d')->default(0);

            $table->bigInteger('issued_total_quantity')->default(0);

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
        Schema::dropIfExists('stocks');
    }
}
