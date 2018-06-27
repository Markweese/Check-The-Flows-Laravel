<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = [
        'station_id', 'usgs_id', 'year_start', 'year_end', 'mean_1', 'max_1', 'min_1', 'mean_2', 'max_2', 'min_2','mean_3', 'max_3', 'min_3','mean_4', 'max_4', 'min_4','mean_5', 'max_5', 'min_5','mean_6', 'max_6', 'min_6','mean_7', 'max_7', 'min_7','mean_8', 'max_8', 'min_8','mean_9', 'max_9', 'min_9','mean_10', 'max_10', 'min_10','mean_11', 'max_11', 'min_11','mean_12', 'max_12', 'min_12'
      ];

/**
 * Get station associated with historic data
 */
  public function station() {
    return $this->belongsTo('App\Models\Historic');
  }
}
