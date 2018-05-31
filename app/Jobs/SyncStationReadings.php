<?php

namespace App\Jobs;

use DB;
use Auth;
use App\Models\Station;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Interactions\Stations\UpsertReading;

class SyncStationReadings implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
   * state
   *
   * @var object
   */
   protected $station;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($station = null)
    {
      $this->station = Station::find($station);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      $stations = [];
      $client = new \GuzzleHttp\Client();

      if(empty($this->station)) {
        $stations = Station::all();
      } else {
        array_push($stations, $this->station);
      }

      foreach($stations as $station) {
        $url = 'https://waterservices.usgs.gov/nwis/iv/?format=json&sites=' . $station->usgs_id . '&siteType=ST&siteStatus=active';

        try {
          $res = $client->request('GET', $url);
          $json_readings = json_decode($res->getBody());
          $usgs_readings = collect($json_readings->value->timeSeries);

          foreach ($usgs_readings as $key=>$value) {
              $currentParam = $value->variable->variableCode[0]->value;

              UpsertReading::run(['station_id' => $station->id, 'usgs_readings' => $value, 'parameter' => $currentParam], TRUE);
          }

        } catch(\Exception $e) {
          \Log::error($e);
        }
      }
    }
}
