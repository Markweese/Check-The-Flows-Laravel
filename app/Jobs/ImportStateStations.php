<?php

namespace App\Jobs;

use DB;
use Auth;
use App\Models\State;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Interactions\Stations\UpsertStation;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportStateStations implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
   * state
   *
   * @var object
   */
   protected $state;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($state = null)
    {
        $this->state = State::find($state);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $states = [];

        $client = new \GuzzleHttp\Client();

        if (empty($this->state)) {
          $states = State::all();
        } else {
          array_push($states, $this->state);
        }

        foreach ($states as $state) {
          $url = 'https://waterservices.usgs.gov/nwis/iv/?format=json&stateCd=' . $state->abbr . '&parameterCd=00060&siteType=ST&siteStatus=active';

          try {
            $res = $client->request('GET', $url);
            $json_stations = json_decode($res->getBody());
            $usgs_stations = collect($json_stations->value->timeSeries);

            foreach ($usgs_stations as $key=>$value) {
                UpsertStation::run(['state' => $state, 'usgs_station' => $value], TRUE);
            }

          } catch (\Exception $e) {
            \Log::error($e);
          }
        }
    }
}
