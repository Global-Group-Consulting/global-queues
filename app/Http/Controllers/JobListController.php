<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJobListRequest;
use App\Http\Requests\UpdateJobListRequest;
use App\Models\JobList;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class JobListController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return View
   */
  public function index(): View {
    return view("jobList.index", [
      "jobs" => JobList::where([])->orderBy("class")->get()
    ]);
  }
  
  /**
   * Show the form for creating a new resource.
   *
   * @return View
   */
  public function create(Request $request): View {
    $clone = $request->query("clone");
    
    if ($clone) {
      $jobToClone = JobList::findOrFail($clone);
    }
    
    return view("jobList.create", [
      "availableClasses" => $this->getClassesList(),
      "jobToClone"       => $jobToClone ?? null,
    ]);
  }
  
  /**
   * Store a newly created resource in storage.
   *
   * @param  StoreJobListRequest  $request
   *
   * @return RedirectResponse
   */
  public function store(StoreJobListRequest $request): RedirectResponse {
    $data = $request->validated();
    
    JobList::create($data);
    
    return redirect()->route("jobList.index");
  }
  
  /**
   * Display the specified resource.
   *
   * @param  JobList  $jobList
   *
   * @return View
   */
  public function show(JobList $jobList): View {
    return view();
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  JobList  $jobList
   *
   * @return View
   */
  public function edit(JobList $jobList): View {
    return view("jobList.edit", [
      "job"              => $jobList,
      "availableClasses" => $this->getClassesList()
    ]);
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  UpdateJobListRequest  $request
   * @param  JobList               $jobList
   *
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateJobListRequest $request, JobList $jobList) {
    $data = $request->validated();
    
    $jobList->update($data);
    
    return redirect()->route("jobList.index");
  }
  
  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   *
   * @return \Illuminate\Http\Response
   */
  public function destroy(JobList $jobList) {
    $jobList->delete();
    
    return redirect()->route("jobList.index");
  }
  
  private function getClassesList() {
    $path  = app_path('Jobs');
    $files = (new Filesystem())->allFiles($path);
  
    return array_map(function ($file) {
      $name = str_replace('.' . $file->getExtension(), "", $file->getFilename());
    
      return [
        "text"  => $name,
        "value" => "App\Jobs\\" . $name
      ];
    }, $files);
  }
  
  public function execute(Request $request, JobList $jobList) {
    $className = $jobList->class;
    
    try {
      $className::dispatch([])->onQueue($jobList->queueName);
//      $className::dispatchSync([])
      
      return redirect()->route("job.index");
    }catch (\Exception $e) {
      return redirect()->route("jobList.index")->with("error", $e->getMessage());
    }
  }
}
