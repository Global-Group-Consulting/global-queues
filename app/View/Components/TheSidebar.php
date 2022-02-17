<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use mikehaertl\tmp\File;

class TheSidebar extends Component {
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct() {
    //
  }
  
  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render() {
    $links = [
      [
        "url"    => "/",
        "icon"   => "fa-tachometer-alt",
        "text"   => "Home",
        "active" => (strpos(Route::currentRouteName(), 'home') === 0)
      ],
      [
        "url"    => route("job.index"),
        "icon"   => "fa-hourglass-start",
        "text"   => "Job in coda",
        "active" => (strpos(Route::currentRouteName(), 'job.index') === 0)
      ],
      [
        "url"    => route("failedJob.index"),
        "icon"   => "fa-triangle-exclamation text-danger",
        "text"   => "Job Falliti",
        "active" => (strpos(Route::currentRouteName(), 'failedJob.index') === 0)
      ],
      
      [
        "url"    => route("jobResult.index"),
        "icon"   => "fa-check-double text-success",
        "text"   => "Job completati (Risultati)",
        "active" => (strpos(Route::currentRouteName(), 'jobResult.index') === 0)
      ],
      
      [
        "url"     => route("jobList.index"),
        "icon"    => "fa-list",
        "text"    => "Job registrati",
        "active"  => (strpos(Route::currentRouteName(), 'jobList.index') === 0),
        "divider" => "top"
      ],
    ];
    
    return view('components.the-sidebar', compact("links"));
  }
}
