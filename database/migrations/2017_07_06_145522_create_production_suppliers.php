<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionSuppliers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('production_id')->nullable();
            $table->text('job_order_no');
            $table->text('production_type');
            $table->text('company_name');
            $table->text('point_person');
            $table->text('contact');
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
        Schema::dropIfExists('production_suppliers');
    }
}
