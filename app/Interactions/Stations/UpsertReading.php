<?php

namespace App\Interactions\Stations;

use DB;
use Carbon\Carbon;
use App\Models\State;
use App\Models\Reading;
use App\Interactions\BaseInteraction;

class UpsertReading extends BaseInteraction {

  /**
   * Parameter validations
   *
   * @var array
   */
  public $validations = [
    'usgs_readings' => 'required',
    'station_id' => 'required',
    'parameter' => 'required',
  ];

  /**
   * Create Client with Quickbooks Customer object
   *
   * @return client object
   */

   public function execute() {
     //time and reading variables
     $readingTime = Carbon::parse($this->usgs_readings->values[0]->value[0]->dateTime)->format('Y-m-d H:i:s');
     $readingValue = $this->usgs_readings->values[0]->value[0]->value;

     //checks the current parameter
     $currentParam = ($this->parameter == '00060' ? 'cfs' :
                     ($this->parameter == '00020' ? 'temp' :
                     ($this->parameter == '00400' ? 'ph' :
                     ($this->parameter == '00095' ? 'conductance' :
                      null))));

      //data for the create/update
      $data = [
        'station_id' => $this->station_id,
        'reading_time' => $readingTime,
        $currentParam => $readingValue,
      ];

      if(!empty($currentParam)){

        //if the station id and reading time match, place the new reading in that row
        if($reading = Reading::where('station_id', $this->station_id)->where('reading_time', $readingTime)->first()) {
          $reading->update([$currentParam => $readingValue]);
          echo('-');

        } else {

          echo('.');
          Reading::create($data);
        }
      }
   }
}
