<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model {

  protected $fillable = [
    'name', 'usgs_id', 'lat', 'lng', 'state_id', 'huc8', 'updated_at', 'created_at'
  ];

  protected $with = [
    'readings', 'initiatives'
  ];

/**
 * Get state associated with station
 */
  public function state() {
    return $this->belongsTo('App\Models\State');
  }

  /**
   * Get readings associated with station
   */
  public function readings() {
      return $this->hasMany('App\Models\Reading');
  }

  /**
   * Get users associated with station
   */
  public function users() {
    return $this->belongsToMany('App\Models\User');
  }

  /**
   * Get initiatives associated with station
   */
  public function initiatives() {
    return $this->hasMany('App\Models\Initiative', 'state_id', 'state_id');
  }

   /**
   * Get historic data associated with station
   */
  public function historic() {
    return $this->hasOne('App\Models\Historic');
  }

}
