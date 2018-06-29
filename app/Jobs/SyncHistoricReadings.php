<?php

namespace App\Jobs;

use DB;
use Auth;
use App\Models\Station;
use App\Models\Historic;
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
      $num_historic = Historic::count();
      $client = new \GuzzleHttp\Client();

      if(empty($this->station)) {
        $stations = Station::where('id', '>', $num_historic)->get();
      } else {
        array_push($stations, $this->station);
      }

      foreach($stations as $station) {
        if (Historic::where('usgs_id', $station->usgs_id)->count()) {
            echo 'has';
        } else {
            //goes to the site selection page and scrapes for ts_id and site_id
            $summaryStats = array();
            $startYear = null;
            $endYear = null;
            $htmlUrl = 'https://waterdata.usgs.gov/nwis/monthly/?format=sites_selection_links&search_site_no=' . $station->usgs_id . '&amp;referred_module=sw';
            $ts_id = null;
            $site_id = null;
            $stats_url = null;

            //domdocument grabs the html, and only parses out input elements
            try {
            $dom = new \DOMDocument;
            @$dom->loadHTMLFile($htmlUrl);
            $inputs = $dom->getElementsByTagName('input');

                foreach ( $inputs as $i => $value) {
                    //name grabs inputs with a matching name attr
                    //paramCheck makes sure it is a 00060 measurement
                    //*paramCheck will break if the html page structure changes
                    $name = $inputs[$i]->getAttribute('name');
                    $paramCheck = null;

                    //make sure the following element exists, and grab it's parameter id
                    if($inputs[$i+1] != null) {
                        $paramCheck = $inputs[$i+1]->getAttribute('value');
                    }

                    //grab the ts_id element, and make sure the following param is cfs
                    if($name == 'ts_id_' . $station->usgs_id && $paramCheck == '00060') {
                        $ts_id = $inputs[$i]->getAttribute('value');
                    }

                    //grab site_id. 
                    //This value stays consistent throughout the page, unlike ts_id
                    if($name == 'site_id_' . $station->usgs_id) {
                        $site_id = $inputs[$i]->getAttribute('value');
                    }

                    //break the loop once we've got our keys
                    if(!empty($ts_id) && !empty($site_id)) {
                        break;
                    }
                }
            } catch(\Exception $e) {
                echo $e->getMessage();
                \Log::error($e);
            }
            //Start grabbing tab delmimited data
            
            //url for rdb file
            $stats_url =  'https://waterdata.usgs.gov/nwis/monthly?site_no=' . $station->usgs_id  . '&agency_cd=USGS&por_' . $station->usgs_id  . '_' . $ts_id  . '=' . $site_id  . ',00060,' . $ts_id  . ',1930-01,2018-06&referred_module=sw&format=rdb';
            
            //gets and stores the tab delimited file
            try {
            $res = $client->request('GET', $stats_url);
            $rdbString = $res->getBody()->getContents();

            //separate out rdb into rows and create the stats array
            $rdbRows = explode(PHP_EOL, $rdbString);
            $historicStats = array();

            //run through each row, if there's 7 columns and the 5th is a numeric value, push to historicStats
            foreach ($rdbRows as $row) {
                $stats = str_getcsv($row, "\t");

                if(count($stats) == 7 && ctype_digit($stats[5])) {
                    $historicStats[$stats[5]][] = $stats[6];
                    
                    //if the current year is lower than the min, change the min
                    if($stats[4] < $startYear || empty($startYear)) {
                        $startYear = $stats[4];
                    }

                    //if the current year is higher than the max, change the max
                    if($stats[4] > $endYear || empty($endYear)) {
                        $endYear = $stats[4];
                    }
                }
            }

            //get monthly summary stats
            foreach($historicStats as $key => $stats) {
                $summaryStats['max_' . $key] = floatval(max($stats));
                $summaryStats['min_' . $key] = floatval(min($stats));
                $summaryStats['mean_' . $key] = round(array_sum($stats)/count($stats),2);
            }

            $summaryStats['year_start'] = intval($startYear);
            $summaryStats['year_end'] = intval($endYear);
            $summaryStats['usgs_id'] = $station->usgs_id;
            $summaryStats['station_id'] = intval($station->id);

            //go to the upsert
            if($startYear > 0 && strlen($summaryStats['usgs_id']) == 8) {
                UpsertHistoric::run($summaryStats, TRUE); 
            }

            } catch(\Exception $e) {
                echo $e->getMessage();
                \Log::error($e);
            }
        }
      }
    }
}
