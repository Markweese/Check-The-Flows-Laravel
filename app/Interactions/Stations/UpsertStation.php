<?php

namespace App\Interactions\Stations;

use DB;
use Carbon\Carbon;
use App\Models\State;
use App\Models\Station;
use App\Interactions\BaseInteraction;

class UpsertStation extends BaseInteraction {

  /**
   * Parameter validations
   *
   * @var array
   */
  public $validations = [
    'state' => 'required',
    'usgs_station' => 'required',
  ];

  /**
   * Create Client with Quickbooks Customer object
   *
   * @return client object
   */

   public function execute() {

      Station::create([
          'name' => $this->usgs_station->sourceInfo->siteName,
          'usgs_id' => $this->usgs_station->sourceInfo->siteCode[0]->value,
          'lat' => $this->usgs_station->sourceInfo->geoLocation->geogLocation->latitude,
          'lng' => $this->usgs_station->sourceInfo->geoLocation->geogLocation->longitude,
          'state_id' => $this->state->id,
      ]);
   }
}
