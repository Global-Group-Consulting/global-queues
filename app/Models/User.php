<?php

namespace App\Models;

use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin \Jenssegers\Mongodb\Eloquent\Builder
 */
class User extends Authenticatable {
  use HasApiTokens, HasFactory, Notifiable;
  
  protected $connection = "mongodb_legacy";
  
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'firstName',
    'lastName',
    'email',
    'roles',
    'apps',
  ];
  
  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];
  
  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];
  
}
