<?php

namespace App\Jobs;

use App\Classes\BasicJob;
use App\Models\User;

class TriggerUserRecapitalization extends BasicJob {
  private User $user;
  
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(User $user = null) {
    if ( !isset($user)) {
      $user = User::first();
    }
    
    $this->user = $user;
  }
  
  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    // problema certificato https
    $this->makeHttpCall(self::class, ["userId"=> $this->user->_id]);
  }
}
