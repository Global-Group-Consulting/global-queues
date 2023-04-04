<?php

namespace App\Jobs;

use App\Classes\BasicJob;

class TriggerAgentCommissionsBlock extends BasicJob {
  public $data;
  
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
    $this->makeHttpCall(self::class, ["id" => $this->data["_id"]]);
  }
}
