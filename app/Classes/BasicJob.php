<?php
namespace App\Classes;

use App\Models\JobList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Client\Response;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\ManuallyFailedException;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

abstract class BasicJob implements ShouldQueue {
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
  /**
   * @var mixed
   */
  protected $data;
  
  /**
   * @var JobList|null
   */
  protected JobList $jobSettings;
  
  /**
   * @var string
   */
  protected string $selfName;
  
  protected function fetchJobSettings() {
    $job = JobList::where("class", "=", $this->selfName)->first();
    
    if ( !$job) {
      throw new ManuallyFailedException("Can't find configuration for this job");
    }
    
    $this->jobSettings = $job;
  }
  
  /**
   * @return array
   */
  public function get_data(): array {
    $toReturn = [];
    
    if (gettype($this->data) === "string") {
      try {
        $toReturn = json_decode(base64_decode($this->data), true);
      } catch (\Exception $er) {
        var_dump($er);
      }
    } elseif (is_array($this->data)) {
      $toReturn = $this->data;
    }
    
    return $toReturn;
  }
  
  /**
   * @param  string  $selfName
   *
   * @return Job
   */
  public function makeHttpCall(string $selfName, array $params = null): Job {
    $this->selfName = $selfName;
    $this->fetchJobSettings();
    
    $payload = $this->get_data();
    $method  = $this->jobSettings->apiMethod ?? "post";
    $url     = $this->jobSettings->apiUrl;
    $headers = $this->jobSettings->apiHeaders;
    
    if (isset($params)) {
      foreach ($params as $key => $value) {
        $url = Str::replace("{" . $key . "}", $value, $url);
      }
    }
    
    if ( !$headers) {
      $headers = [];
    } else {
      $headers = json_decode($headers, true);
    }
    
    /**
     * @var Response
     */
    $result = Http::withOptions([])
      ->withHeaders($headers);
    
    if ($this->jobSettings->authType === "Basic") {
      $result = $result->withBasicAuth($this->jobSettings->authUsername, $this->jobSettings->authPassword);
    }
    
    $result = $result->$method($url, $payload);
    
    if ($result->failed()) {
      throw new ManuallyFailedException(json_encode($result->json()));
    }
    
    $this->job->respData = $result->body();
    $this->job->reqData  = json_encode($payload);
    
    return $this->job;
  }
  
  public function toArray(): array {
    $data = get_object_vars($this);
    
    $data["dataRaw"] = $data["data"];
    $data["data"]    = $this->get_data();
    
    return $data;
  }
  
  public function toJSON(): string {
    $jsonContent = $this->toArray();
    
    return json_encode($jsonContent, JSON_PRETTY_PRINT);
  }
}
