<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Initiative extends Model
{
  protected $fillable = [
    'huc8', 'name', 'logo', 'spokesperson', 'spokesperson_photo', 'statement', 'landing_page', 'state_id', 'updated_at', 'created_at'
  ];

  /**
   * Get associated stations
   *
   */
  public function station() {
    return $this->belongsToMany('App\Models\Station', 'state_id', 'state_id');
  }

  public function state() {
    return $this->belongsTo('App\Models\State');
  }
}
