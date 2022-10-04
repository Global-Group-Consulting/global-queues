<?php

namespace App\Jobs;

use App\Classes\BasicJob;

class AddBritesToPremiumWallet extends BasicJob {
  /**
   * Store incoming notification data.
   *
   * @var $data
   */
  protected $data;
  
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($data) {
    $this->data     = $data;
    $this->selfName = self::class;
  }
  
  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    $this->makeHttpCall(self::class);
  }
}
