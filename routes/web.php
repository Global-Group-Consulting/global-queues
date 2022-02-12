<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  /*\App\Jobs\TriggerBriteRecapitalization::dispatch([
    "userId"     => "867as86asd876ad87ads",
    "amountEuro" => 250,
    "amount"     => 500
  ]);*/
  
  return "hi";
  /*\App\Jobs\SendEmail::dispatch(["firstName" => "Mario",
                                 "lastname"  => "Rossi",
                                 "from"      => "noreply@globalgroup . consulting",
                                 "subject"   => "",
                                 "to"        => "pippo@gmail . com",
                                 "alias"     => "main - account - approved"
  ]);*/
  
  /*$job = \App\Models\Job::all()->last();
//  dump($job);
  $data = $job->payload;
  
  $jsonData = json_decode($data, true);
  dump($jsonData);

// return $jsonData;
//  return ($jsonData["data"]["command"]);
  $res = unserialize($jsonData["data"]["command"]);
  
  dump($res);
  
  print_r($res);

//  dispatch(new \App\Jobs\SomeJob("Some data"));
  
  return "Hi";*/
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
