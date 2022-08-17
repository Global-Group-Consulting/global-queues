<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * @mixin Builder
 *
 * @property string $_id
 * @property string $name
 * @property mixed  $data
 * @property string $type
 * @property string $priority
 * @property string $nextRunAt
 * @property string $lastModifiedBy
 * @property string $lockedAt
 * @property string $lastRunAt
 * @property mixed  $result
 * @property string $lastFinishedAt
 * @property string $completed
 * @property int    $failCount
 * @property string $failReason
 * @property string $failedAt
 */
class MongoJob extends Model {
  use HasFactory;
  
  protected $fillable = [
    "_id",
    "name",
    "data",
    "type",
    "priority",
    "nextRunAt",
    "lastModifiedBy",
    "lockedAt",
    "lastRunAt",
    "result",
    "lastFinishedAt",
    "completed",
    "failCount",
    "failReason",
    "failedAt",
  ];
  
  protected $connection = "mongodb_legacy";
  protected $table = 'queueJobs';
  
  /**
   * The attributes that should be cast.
   *
   * @var array
   */
  protected $casts = [
    'nextRunAt'      => 'datetime:Y-m-d',
    'lockedAt'       => 'datetime:Y-m-d',
    'lastRunAt'      => 'datetime:Y-m-d',
    'lastFinishedAt' => 'datetime:Y-m-d',
    'failedAt'       => 'datetime:Y-m-d',
  ];
  
  protected $dates = [
    "data.createdAt",
    "data.data.birthDate",
    "data.data.contractSignedAt",
  ];
  
}
