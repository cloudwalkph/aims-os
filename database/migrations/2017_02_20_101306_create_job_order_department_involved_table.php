<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobOrderDepartmentInvolvedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_order_department_involved', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('job_order_id')->unsigned();
            $table->integer('department_id');
            $table->string('deliverables')->nullable();
            $table->timestamp('deadline');
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
        Schema::dropIfExists('job_order_department_involved');
    }
}
