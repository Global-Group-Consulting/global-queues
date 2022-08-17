<?php

namespace App\Http\Controllers;

use App\Models\FailedJob;
use App\Models\MongoJob;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class MongoJobController extends Controller {
  
  public function index(Request $request) {
    $query           = collect($request->query());
    $filters         = collect($query->get("filters"));
    $sqlQueryBuilder = MongoJob::take(1000)->orderBy("lastRunAt", "desc");
    
    if ($filters->count() > 0) {
      $filters->each(function ($value, $key) use ($sqlQueryBuilder) {
        if (is_null($value)) {
          return;
        }
        
        if ($key == "failed") {
          $sqlQueryBuilder->whereNotNull("failedAt");
        } elseif ($key === "not_failed") {
          $sqlQueryBuilder->whereNull("failedAt");
        } else {
          $sqlQueryBuilder->where($key, $value);
        }
      });
    }
    
    /**
     * Fetch first 1000 records and then manually paginate them
     * due to the impossibility of paginating large amounts of data while sorting
     *
     * @var MongoJob $job
     */
    $jobs = $sqlQueryBuilder->get();
    
    // Manually paginate the results
    $page        = LengthAwarePaginator::resolveCurrentPage();
    $perPage     = 30;
    $perPageJobs = $jobs->slice(($page - 1) * $perPage, $perPage);
    $pagination  = new LengthAwarePaginator($perPageJobs, $jobs->count(), $perPage, $page, [
      "path" => LengthAwarePaginator::resolveCurrentPath(),
    ]);
    
    return view("mongoJobs.index", [
      "jobs" => $pagination->withQueryString()
    ]);
  }
  
  public function show(MongoJob $job) {
    return view("mongoJobs.show", [
      "job" => new MongoJob($job->toArray())
    ]);
  }
}
