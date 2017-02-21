<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrderMomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_order_moms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_order_id')->unsigned();
            $table->string('agenda');
            $table->datetime('date_and_time');
            $table->string('location');
            $table->text('attendees');
            $table->mediumText('campaign_overview');
            $table->mediumText('activations_flow');
            $table->mediumText('next_step_deliverables');
            $table->mediumText('other_details');
            $table->enum('status', ['active', 'revision'])->default('active');
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
        Schema::dropIfExists('job_order_moms');
    }
}
