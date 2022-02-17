<?php

namespace App\Console\Commands;

use App\Models\FailedJob;
use App\Models\Job;
use Illuminate\Console\Command;

class test extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'test:run';
  
  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command description';
  
  /**
   * Create a new command instance.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct();
  }
  
  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle() {
//    $last = FailedJob::where([])->get()->first();
    $last = Job::all()->last();
    $payload = json_decode($last->payload, true);
    $command = $payload["data"]["command"];
    
    $res = unserialize($command);
    dump($res->get_data());
    
    return 0;
  }
}
