<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model {

  protected $fillable = [
    'name', 'usgs_id', 'lat', 'lng', 'state'
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

}
