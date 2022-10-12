<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FailedJobBtns extends Component {
  public $job;
  public $payload;
  
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($job, $payload) {
    $this->job     = $job;
    $this->payload = $payload;
  }
  
  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render() {
    return view('components.failed-job-btns');
  }
}
