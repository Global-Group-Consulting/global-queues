<?php
namespace App\Classes;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class BasicJob implements ShouldQueue {
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
  protected $data;
  
  /**
   * @return array
   */
  public function get_data(): array {
    return $this->data;
  }
  
  public function toArray(): array {
    return get_object_vars($this);
  }
  
  public function toJSON(): string {
    $jsonContent = $this->toArray();
    
    return json_encode($jsonContent, JSON_PRETTY_PRINT);
  }
}
