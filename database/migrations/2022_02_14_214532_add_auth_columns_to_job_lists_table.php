<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthColumnsToJobListsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('job_lists', function (Blueprint $table) {
      $table->string("authType");
      $table->string("authUsername");
      $table->string("authPassword");
    });
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('job_lists', function (Blueprint $table) {
      $table->dropColumn(["authType", "authUsername", "authPassword"]);
    });
  }
}
