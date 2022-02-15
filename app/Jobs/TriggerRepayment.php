<?php

namespace App\Jobs;

use App\Models\JobList;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\ManuallyFailedException;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class TriggerRepayment implements ShouldQueue {
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
  /**
   * @var array{userId: string, amount: float, notes: string}
   */
  protected $data;
  
  /**
   * @var JobList
   */
  protected $jobSettings;
  
  /**
   * Create a new job instance.
   *
   * @param  array{userId: string, amount: float, notes: string}  $data
   *
   * @return void
   */
  public function __construct(array $data) {
    $this->data = $data;
  }
  
  /**
   * Execute the job.
   *
   * @return void
   * @throws Exception | ManuallyFailedException
   */
  public function handle() {
    $selfName          = self::class;
    $this->jobSettings = JobList::where("class", "=", $selfName)->first();
    
    if ( !$this->jobSettings) {
      throw new ManuallyFailedException("Can't find configuration for this job");
    }
    
    $payload = unserialize($this->job->payload()['data']['command']);
    $method  = $this->jobSettings->apiMethod ?? "post";
    $url     = $this->jobSettings->apiUrl;
    $headers = $this->jobSettings->apiHeaders;
    
    if ( !$headers) {
      $headers = [];
    } else {
      $headers = json_decode($headers, true);
    }
    
    try {
      /**
       * @var Response
       */
      $result = Http::withOptions([])
        ->withHeaders($headers);
      
      if ($this->jobSettings->authType === "Basic") {
        $result = $result->withBasicAuth($this->jobSettings->authUsername, $this->jobSettings->authPassword);
      }
      
      $result = $result->$method($url, $payload->data);
      
      
      if ($result->failed()) {
        $result->throw();
        
        return;
      }
      
      $this->job->respData = $result->body();
      $this->job->reqData  = json_encode($payload->data);
    } catch (Exception $exception) {
      dump($exception);
      throw $exception;
    }
  }
}
