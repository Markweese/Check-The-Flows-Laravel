<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    protected $fillable = [
        'station_id', 'usgs_id', 'year_start', 'year_end', '1_mean', '1_max', '1_min', '2_mean', '2_max', '2_min','3_mean', '3_max', '3_min','4_mean', '4_max', '4_min','5_mean', '5_max', '5_min','6_mean', '6_max', '6_min','7_mean', '7_max', '7_min','8_mean', '8_max', '8_min','9_mean', '9_max', '9_min','10_mean', '10_max', '10_min','11_mean', '11_max', '11_min','12_mean', '12_max', '12_min'
      ];

      /**
 * Get station associated with historic data
 */
  public function station() {
    return $this->belongsTo('App\Models\Historic');
  }
}
