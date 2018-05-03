<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
  protected $fillable = [
    'reading', 'parameter', 'reading_time', 'usgs_id'
  ];

  /**
   * Get associated stations
   *
   * @return array
   */
  public function stations() {
    return $this->belongsTo('App\Models\Station');
  }
}
