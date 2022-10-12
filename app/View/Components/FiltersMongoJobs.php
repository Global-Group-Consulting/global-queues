<?php

namespace App\View\Components;

use App\Models\JobList;
use App\Models\MongoJob;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class FiltersMongoJobs extends Component {
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
    $request = Request::capture();
    $query   = collect($request->query());
    $filters = collect($query->has("filters") ? $query->get("filters") : []);
    
    $availableJobs = MongoJob::orderBy("name")->distinct("name")->get()->map(function ($item) {
      $name = $item->toArray()[0];
      
      return ["text" => $name, "value" => $name];
    });
  
    $availableJobs = $availableJobs->sortBy("value");

//    $availableJobs   = JobList::distinct()->get("class")->map(function ($item) {
//      return ["text"  => last(explode("\\", $item["class"])),
//              "value" => $item["class"]];
//    });
    
    $availableJobs->prepend(["text" => "-", "value" => ""]);

//    $availableJobs->prepend(["text" => "-", "value" => ""]);
    
    return view('components.filters-mongo-jobs', [
      "query"         => $query,
      "filters"       => $filters,
      "availableJobs" => $availableJobs,
//      "availableJobs"   => $availableJobs,
    ]);
  }
}
