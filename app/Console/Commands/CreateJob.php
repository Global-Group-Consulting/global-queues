<?php

namespace App\Console\Commands;

use App\Classes\BasicJob;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateJob extends Command {
  
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'make:job-http {jobName}';
  
  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Create a new HTTP job';
  
  protected function fileTemplate($name): string {
    return "<?php

namespace App\Jobs;

use App\Classes\BasicJob;

class $name extends BasicJob {
  public \$data;

  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct(\$data) {
    \$this->data = \$data;
    \$this->selfName = self::class;
  }
  
  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    \$this->makeHttpCall(self::class);
  }
}
";
  }
  
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
  public function handle(): int {
    $name = $this->argument('jobName');
    $name = Str::studly($name);
    
    $path = app_path("Jobs/$name.php");
    
    if (file_exists($path)) {
      $this->error("File $path already exists");
      
      return 1;
    }
    
    fwrite(fopen($path, 'w'), $this->fileTemplate($name));
    
    return 0;
  }
}
