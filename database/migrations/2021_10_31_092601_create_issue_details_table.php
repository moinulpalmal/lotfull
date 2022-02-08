<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIssueDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_details', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('receive_master_id')->unsigned();
            $table->bigInteger('receive_detail_id')->unsigned();

            $table->string('reference_no', 150)->nullable();
            $table->date('issue_date')->nullable();

            $table->string('issue_type', 2)->nullable();
            $table->string('issued_to', 2)->nullable();

            $table->bigInteger('location_id')->unsigned();

            $table->bigInteger('unit_id')->unsigned();
            $table->bigInteger('issued_total_quantity')->default(0);

            $table->bigInteger('grade_a')->default(0);
            $table->bigInteger('grade_b')->default(0);
            $table->bigInteger('grade_c')->default(0);
            $table->bigInteger('grade_d')->default(0);

            $table->string('status', 4)->default('A');
            $table->bigInteger('inserted_by')->unsigned()->nullable();
            $table->bigInteger('last_updated_by')->unsigned()->nullable();

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
        Schema::dropIfExists('issue_details');
    }
}
