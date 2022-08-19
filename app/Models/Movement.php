<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * CREATED ONLY TO BE USED BY THE JOBS PARSERS WHEN THEY RECEIVE A JOB THAT CONTAINS AN INSTANCE OF THIS MODEL
 *
 * @mixin Builder
 *
 * @property string $_id
 * @property string $userId
 * @property float  $amountChange
 * @property string $movementType
 * @property string $referenceSemester
 * @property string $usableFrom
 * @property string $expiresAt
 * @property string $createdAt
 * @property string $updatedAt
 * @property string $semesterId
 * @property string $clubPack
 */
class Movement extends Model {
  use HasFactory;
}
