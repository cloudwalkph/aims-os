<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category');
            $table->string('subcategory');
            $table->string('venue');
            $table->string('area');
            $table->string('sub_area');
            $table->string('street');
            $table->string('rate')->default('0');
            $table->string('rate_max')->default('0');
            $table->integer('eft')->default(0);
            $table->integer('eft_male')->default(0);
            $table->integer('eft_female')->default(0);
            $table->integer('target_hits')->default(0);
            $table->integer('actual_hits')->default(0);
            $table->integer('actual_hits_f')->default(0);
            $table->string('actual_dry_m')->default('0');
            $table->string('actual_dry_f')->default('0');
            $table->string('actual_exper_m')->default('0');
            $table->string('actual_exper_f')->default('0');
            $table->string('lsm')->default('0');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->string('contact_email')->nullable();
            $table->text('remarks')->nullable();
            $table->string('images')->nullable();
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
        Schema::dropIfExists('venues');
    }
}
