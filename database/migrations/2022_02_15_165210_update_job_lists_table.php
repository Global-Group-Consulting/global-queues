<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateJobListsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('job_lists', function (Blueprint $table) {
      $table->text("payloadValidation")->nullable()->change();
      $table->text("apiHeaders")->nullable()->change();
      $table->string("apiMethod", 10)->nullable()->change();
      $table->string("apiUrl")->nullable()->change();
      $table->string("authType")->nullable()->change();
      $table->string("authUsername")->nullable()->change();
      $table->string("authPassword")->nullable()->change();
    });
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    //
  }
}
