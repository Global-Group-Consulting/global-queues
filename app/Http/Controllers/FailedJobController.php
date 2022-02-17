<?php

namespace App\Http\Controllers;

use App\Models\FailedJob;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class FailedJobController extends Controller {
  public function index() {
    $jobs = FailedJob::orderBy("failed_at", "desc")->where([])->paginate();
    
    return view("failedJob.index", compact("jobs"));
  }
  
  public function retry(FailedJob $failedJob) {
    Artisan::call('queue:retry ' . $failedJob->uuid);
    
    return redirect()->route("home");
  }
  
  public function destroy(FailedJob $failedJob): RedirectResponse {
    Artisan::call('queue:forget ' . $failedJob->uuid);
    
    return redirect(url()->previous());
  }
}
