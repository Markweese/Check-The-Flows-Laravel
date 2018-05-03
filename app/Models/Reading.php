<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reading extends Model
{
  protected $fillable = [
    'reading', 'parameter', 'reading_at', 'usgs_id', 'updated_at', 'created_at'
  ];

  /**
   * Get associated stations
   *
   */
  public function station() {
    return $this->belongsTo('App\Models\Station');
  }
}
