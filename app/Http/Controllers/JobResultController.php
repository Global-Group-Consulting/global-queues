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
  public function index(Request $request) {
    $query           = collect($request->query());
    $filters         = collect($query->get("filters"));
    $sqlQueryBuilder = JobResult::orderBy("created_at", "desc");
    
    if ($filters->count() > 0) {
      $filters->each(function ($value, $key) use ($sqlQueryBuilder) {
        if (is_null($value)) {
          return;
        }
        
        $sqlQueryBuilder->where($key, $value);
      });
    }
    
    $jobs = $sqlQueryBuilder->paginate();
    
    return view("jobResult.index", [
      "jobs" => $jobs
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
