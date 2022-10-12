<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class JobController extends Controller {
  
  /**
   * Display a listing of the resource.
   *
   * @return View
   */
  public function index(): View {
    /**
     * @var LengthAwarePaginator $data
     */
    $data = Job::where([])->orderBy("created_at", "DESC")->paginate();
    
    return view("job.index", [
      "jobs" => $data
    ]);
  }
  
  /**
   * Display the specified resource.
   *
   * @param  Job  $job
   *
   * @return View
   */
  public function show(Job $job): View {
    return view("jobResult.show", compact("job"));
  }
  
  public function destroy(Job $job): RedirectResponse {
    $job->delete();
    
    return redirect(url()->previous());
  }
}
