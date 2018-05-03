<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  protected $fillable = [
    'name', 'abbr'
  ];

  public $timestamps = false;

  public function stations() {
    $this->hasMany('App\Models\Station');
  }
}
