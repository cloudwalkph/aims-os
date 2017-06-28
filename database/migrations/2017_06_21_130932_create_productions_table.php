<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->increments('id' );
            $table->text('job_order_no' );
            $table->integer('status' )->default('0');
            $table->timestamps();
        });

        Schema::create('production_items', function (Blueprint $table) {
            $table->increments('id' );
            $table->integer('production_id')->unsigned();
            $table->foreign('production_id')
                  ->references('id')->on('productions')
                  ->onDelete('cascade');
            $table->string('type' );
            $table->text('description' )->nullable();
            $table->text('visuals' )->nullable();
            $table->text('sizes' )->nullable();
            $table->integer('qty' )->nullable();
            $table->text('details' )->nullable();
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
        Schema::dropIfExists('productions');
        Schema::dropIfExists('productions_tarpaulin');
    }
}
