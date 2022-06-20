<?php

namespace App\Console;

use App\Jobs\Ping;
use App\Jobs\TriggerMonthlyRecapitalization;
use App\Models\JobList;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
  /**
   * Define the application's command schedule.
   *
   * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
   *
   * @return void
   */
  protected function schedule(Schedule $schedule) {
    // $schedule->command('inspire')->hourly();
    $monthlyRecapitalizeJob = JobList::where('class', 'App\Jobs\TriggerMonthlyRecapitalization')
      ->first();
    
    $schedule->job(new TriggerMonthlyRecapitalization(), $monthlyRecapitalizeJob->queueName)
      ->monthlyOn(16, '02:00')
      ->timezone('Europe/Rome')
      ->environments(['production']);
  }
  
  /**
   * Register the commands for the application.
   *
   * @return void
   */
  protected function commands() {
    $this->load(__DIR__ . '/Commands');
    
    require base_path('routes/console.php');
  }
}
