<?php

namespace App\Jobs;

use App\Classes\BasicJob;
use App\Models\JobList;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Queue\ManuallyFailedException;
use Illuminate\Support\Facades\Http;

/**
 */
class TriggerBriteRecapitalization extends BasicJob {
  
  /**
   * @var array{userId: string, amountEuro: float, amount: integer}
   */
  protected $data;
  
  /**
   * Create a new job instance.
   *
   * @param  array{userId: string, amountEuro: float, amount: integer}  $data
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
   * @throws ManuallyFailedException | Exception
   */
  public function handle() {
    $this->makeHttpCall(self::class);
  }
}
