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
      echo 'start';
      Historic::create([
        'station_id' => $this->station_id,
        'usgs_id' => $this->usgs_id,
      ]);
   }
}