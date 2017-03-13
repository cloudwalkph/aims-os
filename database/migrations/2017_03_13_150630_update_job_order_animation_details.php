<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateJobOrderAnimationDetails extends Migration
{

    public function __construct()
    {
        DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_order_animation_details', function (Blueprint $table) {
            $table->integer('target_selling')->nullable()->change();
            $table->integer('target_flyering')->nullable()->change();
            $table->integer('target_survey')->nullable()->change();
            $table->integer('target_experiment')->nullable()->change();
            $table->integer('target_others')->nullable()->change();
            $table->integer('target_sampling')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_order_animation_details', function (Blueprint $table) {
            //
        });
    }
}
