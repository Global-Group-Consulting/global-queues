<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToJobListsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('job_lists', function (Blueprint $table) {
      $table->string("apiUrl")->nullable();
      $table->string("apiMethod", 10)->nullable();
      $table->string("apiHeaders")->nullable();
    });
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('job_lists', function (Blueprint $table) {
      $table->dropColumn(["apiUrl", "apiMethod", "apiHeaders"]);
    });
  }
}
