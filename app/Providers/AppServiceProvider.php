<?php

namespace App\Providers;

use App\Models\FailedJob;
use App\Models\JobResult;
use Illuminate\Queue\Events\JobExceptionOccurred;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use \Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {
    //
  }
  
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    
    Queue::after(function (JobProcessed $event) {
      $payload = $event->job->payload();
      $command = (unserialize($payload['data']['command']));
      
      try {
        // Store in db only the jobs that have a result of some type.
        if (property_exists($event->job, "respData")) {
          $jobResult = JobResult::create([
            "result" => $event->job->respData,
            "uid"    => $event->job->uuid(),
            "name"   => get_class($command),
            "queue"  => $event->job->getQueue(),
          ]);
          
          if (property_exists($event->job, "reqData")) {
            $jobResult["payload"] = $event->job->reqData;
            
            $jobResult->save();
          }
        };
      } catch (\Exception $exception) {
        dump($exception);
      }
    });
    Queue::exceptionOccurred(function (JobExceptionOccurred $event) {
//      dump("exceptionOccurred");
    });
    
    Queue::failing(function (JobFailed $event) {
//      var_dump("failing");
//      $payload = $event->job->payload();
//      $uuid    = $event->job->uuid();

//      $failedJob = FailedJob::where("uuid", $uuid)->first();

//      dump($failedJob);

//      $command = (unserialize($payload['data']['command']));
//      dump($command);
    
    });
  }
}
