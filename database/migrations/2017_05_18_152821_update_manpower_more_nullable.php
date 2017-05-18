<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateManpowerMoreNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manpowers', function(Blueprint $table) {
            $table->string('middle_name')->nullable()->change();
            $table->string('fb_link')->nullable()->change();
            $table->string('contact_number')->nullable()->change();
            $table->string('city')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('manpowers', function (Blueprint $table) {
            //
        });
    }
}
