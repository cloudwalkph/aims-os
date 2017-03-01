<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('job_order_no');
            $table->text('ceNumber')->nullable();
            $table->text('ceFile')->nullable();
            $table->date('ceDateUpdated')->nullable();
            $table->date('transmittalDate')->nullable();
            $table->date('transmittalDateUpdated')->nullable();
            $table->text('invoiceNumber')->nullable();
            $table->text('invoiceFile')->nullable();
            $table->date('invoiceDateUpdated')->nullable();
            $table->date('paidDate')->nullable();
            $table->text('paidFile')->nullable();
            $table->date('paidDateUpdated')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('accountings');
    }
}
