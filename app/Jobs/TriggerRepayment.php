<?php

namespace App\Jobs;

use App\Classes\BasicJob;
use App\Models\JobList;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Queue\ManuallyFailedException;
use Illuminate\Support\Facades\Http;

class TriggerRepayment extends BasicJob {
  /**
   * @var array{userId: string, amount: float, notes: string}
   */
  protected $data;
  
  /**
   * Create a new job instance.
   *
   * @param  array{userId: string, amount: float, notes: string}  $data
   *
   * @return void
   */
  public function __construct(array $data) {
    $this->data     = $data;
    $this->selfName = self::class;
  }
  
  /**
   * Execute the job.
   *
   * @return void
   * @throws Exception | ManuallyFailedException
   */
  public function handle() {
    $this->makeHttpCall(self::class);
  }
}
