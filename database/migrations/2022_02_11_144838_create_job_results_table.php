<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobResultsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('job_results', function (Blueprint $table) {
      $table->id();
      $table->string("uid");
      $table->string("name");
      $table->string("queue");
      $table->longText("payload")->nullable();
      $table->longText("result")->nullable();
      $table->timestamps();
    });
  }
  
  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('job_results');
  }
}
