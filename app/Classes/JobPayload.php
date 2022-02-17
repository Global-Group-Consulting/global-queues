<?php

namespace App\Classes;

use App\Classes\BasicJob;

/**
 * @phpstan-type PayloadData array{commandName: string, command: string}
 *
 * @property-read string      $displayName
 * @property-read string      $job
 * @property-read int|null    $maxTries
 * @property-read int|null    $maxExceptions
 * @property-read bool        $failOnTimeout
 * @property-read int|null    $backoff
 * @property-read int|null    $timeout
 * @property-read int|null    $retryUntil
 * @property-read PayloadData $data
 */
class JobPayload {
  /**
   * @var string
   */
  protected $rawData;
  
  /**
   * @var JobPayload
   */
  protected $arrayData;
  
  /**
   * @var BasicJob
   */
  protected $command;
  
  public function __construct(string $payload) {
    $this->rawData   = $payload;
    $this->arrayData = json_decode($payload, true);
    
    try {
      $this->command = unserialize($this->arrayData["data"]["command"]);
    } catch (\Exception $er) {
      return;
    }
    
    $this->arrayData["data"]["commandRaw"] = $this->arrayData["data"]["command"];
    $this->arrayData["data"]["command"]    = $this->command ? $this->command->toArray() : [];
  }
  
  public function getCommand(): BasicJob {
    return $this->command;
  }
  
  public function getCommandJson(): string {
    return $this->command ? $this->command->toJSON() :"{}";
  }
  
  public function toJson(): string {
    return json_encode($this->arrayData, JSON_PRETTY_PRINT);
  }
  
  public function __get(string $name) {
    if (key_exists($name, $this->arrayData)) {
      return $this->arrayData[$name];
    }
    
    return null;
  }
}
