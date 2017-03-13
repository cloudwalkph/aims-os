<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrderAnimationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_order_animation_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_order_id')->unsigned();
            $table->string('particular');
            $table->string('target_activity');
            $table->integer('target_areas');
            $table->integer('target_duration');
            $table->integer('target_selling');
            $table->integer('target_flyering');
            $table->integer('target_survey');
            $table->integer('target_experiment');
            $table->integer('target_others');
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
        Schema::dropIfExists('job_order_animation_details');
    }
}
