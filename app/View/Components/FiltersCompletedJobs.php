<?php

namespace App\View\Components;

use App\Models\JobList;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class FiltersCompletedJobs extends Component {
  public string $routeName;
  
  /**
   * Create a new component instance.
   *
   * @return void
   */
  public function __construct($routeName) {
    $this->routeName = $routeName;
  }
  
  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\Contracts\View\View|\Closure|string
   */
  public function render() {
    $request         = Request::capture();
    $query           = collect($request->query());
    $filters         = collect($query->has("filters") ? $query->get("filters") : []);
    $availableQueues = JobList::distinct()->get("queueName")->map(function ($item) {
      return ["text" => $item["queueName"], "value" => $item["queueName"]];
    });
    $availableJobs   = JobList::distinct()->get("class")->map(function ($item) {
      return ["text" => last(explode("\\", $item["class"])),
        "value" => $item["class"]];
    });
  
    $availableQueues->prepend(["text" => "-", "value" => ""]);
    $availableJobs->prepend(["text" => "-", "value" => ""]);
    
    return view('components.filters-completed-jobs', [
      "query"           => $query,
      "filters"         => $filters,
      "availableQueues" => $availableQueues,
      "availableJobs"   => $availableJobs,
    ]);
  }
}
