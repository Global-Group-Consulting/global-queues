<?php

namespace App\Jobs;

use App\Classes\BasicJob;
use App\Enums\AccountStatus;
use App\Enums\UserRole;
use App\Models\User;

class TriggerMonthlyRecapitalization extends BasicJob {
  
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct() {
    //
  }
  
  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    $users = User::where([
      "role"           => ["\$in" => [UserRole::CLIENTE, UserRole::AGENTE]],
      "account_status" => ["\$in" => [AccountStatus::ACTIVE, AccountStatus::APPROVED]]
    ])->get();
    
    // For each user, dispatch the job to recalculate the monthly recapitalization
    foreach ($users as $user) {
      TriggerUserRecapitalization::dispatch($user);
    }
  }
}

