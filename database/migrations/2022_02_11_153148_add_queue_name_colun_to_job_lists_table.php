<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQueueNameColunToJobListsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('job_lists', function (Blueprint $table) {
      $table->string("queueName");
    });
  }
  
  /**
   * Reverse the migrations.s
   *
   * @return void
   */
  public function down() {
    Schema::table('job_lists', function (Blueprint $table) {
      $table->dropColumn("queueName");
    });
  }
}
