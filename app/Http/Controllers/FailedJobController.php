<?php

namespace App\Http\Controllers;

use App\Models\FailedJob;
use App\Models\JobList;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use function PHPUnit\Framework\isNull;

class FailedJobController extends Controller {
  public function index(Request $request): View {
    $query           = collect($request->query());
    $filters         = collect($query->get("filters"));
    $sqlQueryBuilder = FailedJob::orderBy("failed_at", "desc");
    
    if ($filters->count() > 0) {
      $filters->each(function ($value, $key) use ($sqlQueryBuilder) {
        if (is_null($value)) {
          return;
        }
        
        if ($key == "job") {
          $sqlQueryBuilder->where("payload->displayName", $value);
        } else {
          $sqlQueryBuilder->where($key, $value);
        }
      });
    }
    
    $jobs = $sqlQueryBuilder->paginate();
    
    return view("failedJob.index", compact("jobs", "query"));
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
