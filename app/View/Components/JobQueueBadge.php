<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JobQueueBadge extends Component {
  public $colorsMap = [];
  public $queue = "";
  public $color;
  
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($job) {
    $this->colorsMap = [
      'default'      => 'secondary',
      'triggers'     => 'info',
      'email'        => 'success',
      'notification' => 'warning',
    ];
    $this->queue     = $job->queue;
    
    $keys = array_keys($this->colorsMap);
    
    foreach ($keys as $key) {
      if (strpos($this->queue, $key) !== false) {
        $this->color = $this->colorsMap[$key];
        break;
      }
    }
    
    if ( !$this->color) {
      $this->color = 'danger';
    }
  }
  
  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render() {
    return view('components.job-queue-badge');
  }
}
