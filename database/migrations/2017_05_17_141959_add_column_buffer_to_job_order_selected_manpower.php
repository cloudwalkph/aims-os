<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBufferToJobOrderSelectedManpower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_order_selected_manpowers', function(Blueprint $table) {
            $table->boolean('buffer')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('job_order_selected_manpowers', function(Blueprint $table) {
            $table->dropColumn('buffer');
        });
    }
}
