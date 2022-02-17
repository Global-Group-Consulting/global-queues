<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @mixin Builder
 */
class JobResult extends Model {
  use HasFactory;
  
  protected $fillable = ["result",
    "payload",
    "uid",
    "name",
    "queue"
  ];
}
