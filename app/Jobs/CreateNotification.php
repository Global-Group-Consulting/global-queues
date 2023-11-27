<?php

namespace App\Jobs;

use App\Classes\BasicJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CreateNotification extends BasicJob {
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
    $this->data = $data;
    // Fake job used as a placeholder. The actual job is in the News App
  }
  
  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    Log::log("info", "creazione notifica in modo sbagliato", $this->data);
    // Fake job used as a placeholder. The actual job is in the News App
  }
}
