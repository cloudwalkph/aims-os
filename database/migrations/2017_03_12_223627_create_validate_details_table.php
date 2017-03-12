<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validate_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_order_id')->unsigned();
            $table->integer('questions_id');
            $table->date('activation_date');
            $table->date('end_date');
            $table->string('event_type');
            $table->string('event_category');
            $table->integer('rater_id');
            $table->integer('ratee_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('job_order_id')
                ->references('id')
                ->on('job_orders')
                ->onDelete('cascade');

            $table->foreign('rater_id')
                ->references('id')
                ->on('job_orders')
                ->onDelete('cascade');

            $table->foreign('ratee_id')
                ->references('id')
                ->on('job_orders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validate_details');
    }
}
