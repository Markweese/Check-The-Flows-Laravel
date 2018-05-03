<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
  protected $fillable = [
    'name', 'abbr'
  ];

  public function stations() {
    $this->hasMany('App\Models\Station');
  }
}
