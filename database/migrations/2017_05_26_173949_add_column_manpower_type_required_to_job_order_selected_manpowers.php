<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnManpowerTypeRequiredToJobOrderSelectedManpowers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_order_selected_manpowers', function(Blueprint $table) {
            $table->integer('manpower_type_required')->nullable();
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
            $table->dropColumn('manpower_type_required');
        });
    }
}
