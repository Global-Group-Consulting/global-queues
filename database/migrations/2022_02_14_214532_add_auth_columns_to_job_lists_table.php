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
      $table->string("authType")->nullable();
      $table->string("authUsername")->nullable();
      $table->string("authPassword")->nullable();
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
