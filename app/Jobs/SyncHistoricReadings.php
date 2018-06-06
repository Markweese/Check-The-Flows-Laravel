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
use App\Interactions\Stations\UpsertHistoric;

class SyncHistoricReadings implements ShouldQueue
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
        $htmlUrl = 'https://waterdata.usgs.gov/nwis/monthly/?format=sites_selection_links&search_site_no=' . $station->usgs_id . '&amp;referred_module=sw';

        $dom = new \DOMDocument;
        //   $res = $client->request('GET', $url);
        //   $html = $res->getBody()->getContents();

        @$dom->loadHTMLFile($htmlUrl);

        $inputs = $dom->getElementsByTagName('input');

        foreach ( $inputs as $input) {
            $name = $input->getAttribute('name');
            $alt = $input->getAttribute('alt');
            if($name == 'ts_id_' . $station->usgs_id) {
                echo $input->getAttribute('value');
                return;
            }
        }
          
        usleep(200000);
      }

      return;
    }
}
