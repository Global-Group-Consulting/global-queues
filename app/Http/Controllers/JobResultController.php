<?php

namespace App\Http\Controllers;

use App\Models\JobResult;
use Illuminate\Http\Request;

class JobResultController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $data = JobResult::where([])->orderBy("created_at", "DESC")->paginate();
    
    return view("jobResult.index", [
      "jobs" => $data
    ]);
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   *
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    //
  }
  
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\Response
   */
  public function show(JobResult $job) {
    return view("jobResult.show", compact("job"));
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    //
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int                       $id
   *
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    //
  }
  
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    //
  }
}
