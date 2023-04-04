<?php

namespace App\Jobs;

use App\Classes\BasicJob;
use App\Models\JobList;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\ObjectId;

class TriggerMonthlyCommissionsBlock extends BasicJob {
  
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct() {
  }
  
  /**
   * Execute the job.
   *
   * @return void
   * @throws \Exception
   */
  public function handle() {
//    DB::connection('mongodb_legacy')->enableQueryLog();
    
    $users = DB::connection('mongodb_legacy')->table("agents_without_blocked_commissions")
      ->project([
        "_id"                 => 1,
        "lastCommissionValue" => "\$lastCommission.currMonthCommissions"])
      ->get();

//    $log = \DB::connection('mongodb_legacy')->getQueryLog();
    
    $queueName = JobList::getJobQueue(TriggerAgentCommissionsBlock::class);
    
    // For each user, dispatch the job to recalculate the monthly recapitalization
    /**
     * @var array{
     *      _id: ObjectId,
     *      lastCommissionValue: float
     *    } $user
     */
    foreach ($users as $user) {
      TriggerAgentCommissionsBlock::dispatch($user)->onQueue($queueName);
    }
  }
}
