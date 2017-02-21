<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrderMealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_order_meals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_order_id');
            $table->integer('meal_type_id');
            $table->integer('quantity');
            $table->string('serving_time');
            $table->string('pickup_by');
            $table->mediumText('remarks');
            $table->enum('status', ['active', 'revision'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('job_order_meals');
    }
}
