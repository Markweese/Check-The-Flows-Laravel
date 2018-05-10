<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  protected $fillable = [
    'name', 'abbr'
  ];

  public $timestamps = false;

  protected $with = [
    'stations', 'initiatives'
  ];

  public function stations() {
    return $this->hasMany('App\Models\Station');
  }

  public function initiatives() {
    return $this->hasMany('App\Models\Initiative');
  }
}
