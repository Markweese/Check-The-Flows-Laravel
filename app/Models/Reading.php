<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
  protected $fillable = [
    'ph', 'temp', 'cfs', 'conductance', 'reading_time', 'station_id',
  ];

  /**
   * Get associated stations
   *
   */
  public function station() {
    return $this->belongsTo('App\Models\Station');
  }
}
