<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_order_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_order_id')->unsigned();
            $table->string('what');
            $table->mediumText('what_notes');
            $table->string('expected_guest');
            $table->mediumText('event_specifications');
            $table->enum('status', ['active', 'revision']);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('job_order_id')
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
        Schema::dropIfExists('job_order_details');
    }
}
