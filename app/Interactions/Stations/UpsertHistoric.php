<?php

namespace App\Interactions\Stations;

use DB;
use Carbon\Carbon;
use App\Models\Station;
use App\Models\Historic;
use App\Interactions\BaseInteraction;

class UpsertHistoric extends BaseInteraction {

  /**
   * Parameter validations
   *
   * @var array
   */
  public $validations = [
    'station_id' => 'required',  
    'usgs_id' => 'required',
  ];

  /**
   * Create Client with Quickbooks Customer object
   *
   * @return client object
   */

   public function execute() {
      Historic::create([
        'station_id' => $this->station_id,
        'usgs_id' => $this->usgs_id,
        'station_id' => $this->station_id,
        'usgs_id' => $this->usgs_id,
        'year_start' => $this->year_start,
        'year_end' => $this->year_end,
        'mean_1' => $this->mean_1,
        'max_1' => $this->max_1,
        'min_1' => $this->min_1,
        'mean_2' => $this->mean_2,
        'max_2' => $this->max_2,
        'min_2' => $this->min_2,
        'mean_3' => $this->mean_3,
        'max_3' => $this->max_3,
        'min_3' => $this->min_3,
        'mean_4' => $this->mean_4,
        'max_4' => $this->max_4,
        'min_4' => $this->min_4,
        'mean_5' => $this->mean_5,
        'max_5' => $this->max_5,
        'min_5' => $this->min_5,
        'mean_6' => $this->mean_6,
        'max_6' => $this->max_6,
        'min_6' => $this->min_6,
        'mean_7' => $this->mean_7,
        'max_7' => $this->max_7,
        'min_7' => $this->min_7,
        'mean_8' => $this->mean_8,
        'max_8' => $this->max_8,
        'min_8' => $this->min_8,
        'mean_9' => $this->mean_9,
        'max_9' => $this->max_9,
        'min_9' => $this->min_9,
        'mean_10' => $this->mean_10,
        'max_10' => $this->max_10,
        'min_10' => $this->min_10,
        'mean_11' => $this->mean_11,
        'max_11' => $this->max_11,
        'min_11' => $this->min_11,
        'mean_12' => $this->mean_12,
        'max_12' => $this->max_12,
        'min_12' => $this->min_12
      ]);

      echo '.';
   }
}