<?php

namespace App\Jobs;

use App\Classes\BasicJob;
use Exception;
use Illuminate\Queue\ManuallyFailedException;

/**
 */
class TriggerBriteRecapitalization extends BasicJob {
  
  /**
   * @var array{userId: string, amountEuro: float, amount: integer, fromUUID: string}
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
