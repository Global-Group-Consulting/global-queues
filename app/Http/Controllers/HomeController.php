<?php

namespace App\Http\Controllers;

use App\Models\FailedJob;
use App\Models\Job;
use Illuminate\Contracts\Queue\Queue;

class HomeController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
//        $this->middleware('auth');
  }
  
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Queue $queue) {
    $failedJobs  = FailedJob::orderBy("failed_at", "DESC")->limit(5)->where([])->get();
    $pendingJobs = Job::orderBy("created_at", "DESC")->limit(5)->where([])->get();
    
    return view('home', [
      "failedJobs"  => $failedJobs,
      "pendingJobs" => $pendingJobs
    ]);
  }
}
