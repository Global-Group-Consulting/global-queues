<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
  "register" => false,
  "reset"    => false,
  "confirm"  => false
]);

Route::middleware("auth")
  ->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  
    Route::resource("jobList", \App\Http\Controllers\JobListController::class);
    Route::post("jobList/execute/{jobList}", [\App\Http\Controllers\JobListController::class, "execute"])->name("jobList.execute");
  
    Route::get("jobResult", [\App\Http\Controllers\JobResultController::class, "index"])->name("jobResult.index");
    Route::get("jobResult/{job}", [\App\Http\Controllers\JobResultController::class, "show"])->name("jobResult.show");
  
    Route::get("job", [\App\Http\Controllers\JobController::class, "index"])->name("job.index");
    Route::get("job/{job}", [\App\Http\Controllers\JobController::class, "show"])->name("job.show");
    Route::delete("job/{job}", [\App\Http\Controllers\JobController::class, "destroy"])->name("job.destroy");
  
    Route::get("failedJob", [\App\Http\Controllers\FailedJobController::class, "index"])->name("failedJob.index");
    Route::patch("failedJob/{failedJob}/retry", [\App\Http\Controllers\FailedJobController::class, "retry"])->name("failedJob.retry");
    Route::delete("failedJob", [\App\Http\Controllers\FailedJobController::class, "destroyAll"])->name("failedJob.destroyAll");
    Route::delete("failedJob/{failedJob}", [\App\Http\Controllers\FailedJobController::class, "destroy"])->name("failedJob.destroy");
  
    Route::get("mongoJobs", [\App\Http\Controllers\MongoJobController::class, "index"])->name("mongoJobs.index");
    Route::get("mongoJobs/{job}", [\App\Http\Controllers\MongoJobController::class, "show"])->name("mongoJobs.show");
  });
