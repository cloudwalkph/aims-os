<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrderVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_order_vehicles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_order_id');
            $table->integer('vehicle_type_id');
            $table->integer('department_id');
            $table->integer('venue_id');
            $table->integer('vehicle_needed');
            $table->double('rate');
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
        Schema::dropIfExists('job_order_vehicles');
    }
}
