<?php

namespace Database\Seeders;

use App\Models\JobList;
use Illuminate\Database\Seeder;

class JobListsSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    JobList::create([
      "title"             => "Send Email",
      "description"       => "Coda che gestice l'invio delle email",
      "class"             => "App\Jobs\SendEmail",
      "queueName"         => ".email",
      "payloadValidation" => "",
      "payloadKey"        => "data",
      "apiUrl"            => null,
      "apiMethod"         => null,
      "apiHeaders"        => null,
    ]);
    
    JobList::create([
      "title"             => "TriggerBriteRecapitalization",
      "description"       => "Lancia la ricapitalizzazione dei brite per un singolo utente",
      "class"             => "App\Jobs\TriggerBriteRecapitalization",
      "queueName"         => ".triggers",
      "payloadValidation" => "",
      "payloadKey"        => "data",
      "apiUrl"            => null,
      "apiMethod"         => null,
      "apiHeaders"        => null,
    ]);
  }
}
