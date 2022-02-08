<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::post("/fill", [\App\Http\Controllers\FileController::class, "fill"]);
Route::post("/fill_and_store", [\App\Http\Controllers\FileController::class, "fillAndStore"]);

Route::get("/{file}/show", [\App\Http\Controllers\FileController::class, "show"]);
Route::delete("/{file}", [\App\Http\Controllers\FileController::class, "destroy"]);
