<?php

namespace App\Console;

use App\Jobs\TriggerCalendarDailyReport;
use App\Jobs\TriggerMonthlyCommissionsBlock;
use App\Jobs\TriggerMonthlyRecapitalization;
use App\Jobs\TriggerPeriodicNotifications;
use App\Models\JobList;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use MongoDB\Collection;

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
  
    $monthlyRecapitalizeJob          = JobList::where('class', 'App\Jobs\TriggerMonthlyRecapitalization')->first();
    $monthlyAgentCommissionsBlockJob = JobList::where('class', 'App\Jobs\TriggerMonthlyCommissionsBlock')->first();
    $dailyCalendarReportJob          = JobList::where('class', 'App\Jobs\TriggerCalendarDailyReport')->first();
  
    // Ricapitalizzazione mensile
    try {
      $schedule->job(new TriggerMonthlyRecapitalization(), $monthlyRecapitalizeJob->queueName)
        ->monthlyOn(16, '02:00')
        ->timezone('Europe/Rome')
        ->environments(['production']);
    } catch (\Exception $e) {
      $message = "Missing configuration for TriggerMonthlyRecapitalization";
    
      dump($message);
      Log::error($message);
    }
  
    // Notifiche giornaliere calendario
    try {
      $schedule->job(new TriggerCalendarDailyReport(), $dailyCalendarReportJob->queueName)
        ->twiceDailyAt(8, 18)
        ->timezone('Europe/Rome')
        ->environments(['production']);
    } catch (\Exception $e) {
      $message = "Missing configuration for TriggerCalendarDailyReport";
    
      dump($message);
      Log::error($message);
    }
  
    // Blocco mensile provvigioni agenti
    try {
      $schedule->job(new TriggerMonthlyCommissionsBlock(), $monthlyAgentCommissionsBlockJob->queueName)
        ->monthlyOn(1, '00:10')
        ->timezone('Europe/Rome')
        ->environments(['production']);
    } catch (\Exception $e) {
      $message = "Missing configuration for TriggerMonthlyCommissionsBlock";
    
      dump($message);
      Log::error($message);
    }
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
