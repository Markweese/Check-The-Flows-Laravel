<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\ImportStateStations;

class ImportStations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stations:import
                            {state_id? : State ID to sync}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import USGS Stations';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      try {
        dispatch((new ImportStateStations($this->argument('state_id')))->onConnection('sync'));
      } catch (\Exception $e) {
        $this->error('Error: ' . $e->getMessage());
        \Log::error($e);
      }
    }
}
