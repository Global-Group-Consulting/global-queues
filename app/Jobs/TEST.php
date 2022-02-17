<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Coconuts\Mail\PostmarkTemplateMailable;
use Illuminate\Support\Facades\Validator;

class SendEmail implements ShouldQueue {
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  
  /**
   * @var array{from: string, alias: string, to: string, subject: string, templateData: array }
   */
  protected $data;
  
  /**
   * Create a new job instance.
   *
   * @return void
   */
  public function __construct($data) {
    $this->data = $data;
  }
  
  /**
   * Execute the job.
   *
   * @return void
   */
  public function handle() {
    $data = Validator::validate($this->data, [
      "to"           => "required|string",
      "from"         => "required|string",
      "subject"      => "string",
      "alias"        => "required|string",
      "templateData" => "required|array",
    ]);
    
    $mailable = (new PostmarkTemplateMailable())
      ->from($data["from"])
      ->alias($data["alias"])
      ->include($data["templateData"]);
    
    if (key_exists("subject", $data)) {
      $mailable->subject($data["subject"]);
    }
    
    Mail::to($data["to"])->send($mailable);
  }
  
  /*public function failed(\Exception $exception) {
    // before general failing
    dump("failed");
  }*/
}
