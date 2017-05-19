<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
          $table->integer('job_order_id')->nullable()->change();
          $table->string('category')->after('job_order_id');
          $table->string('quantity')->after('name');
          $table->string('status')->after('expiration_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
          $table->integer('job_order_id')->change();
          $table->dropColumn(['category', 'quantity', 'status']);
        });
    }
}
