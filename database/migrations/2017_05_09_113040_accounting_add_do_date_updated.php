<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccountingAddDoDateUpdated extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accountings', function(Blueprint $table) {
            $table->string('do_date_updated')->after('do_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accountings', function (Blueprint $table) {
            $table->dropColumn('do_date_updated');
        });
    }
}
