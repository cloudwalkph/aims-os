<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrderManpowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_order_manpowers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_order_id');
            $table->integer('manpower_type_id');
            $table->integer('manpower_needed');
            $table->double('rate');
            $table->mediumText('remarks');
            $table->enum('status', ['active', 'revision', 'pending'])->default('active');
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
        Schema::dropIfExists('job_order_manpowers');
    }
}
