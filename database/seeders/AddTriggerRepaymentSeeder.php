<?php

namespace Database\Seeders;

use App\Models\JobList;
use Illuminate\Database\Seeder;

class AddTriggerRepaymentSeeder extends Seeder {
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run() {
    JobList::create([
      "title"             => "User repayment",
      "description"       => "Coda che gestice i rimborsi fatti agli utenti",
      "class"             => "App\Jobs\TriggerRepayment",
      "queueName"         => ".triggers",
      "payloadValidation" => "",
      "payloadKey"        => "data",
      "apiUrl"            => "https://localhost:3333/api/srv-oeLULBTBa8sBUme-main/repayment",
      "apiMethod"         => "put",
      "apiHeaders"        => '{"server-key":""}',
    ]);
  }
}
