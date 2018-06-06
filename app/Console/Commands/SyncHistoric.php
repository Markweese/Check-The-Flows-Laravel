<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SyncHistoricReadings;

class SyncHistoric extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'historic:sync
                            {station_id? : Station Id to sync}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync stations historic streamflow data with db';

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
            dispatch((new SyncHistoricReadings($this->argument('station_id')))->onConnection('sync'));
          } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            \Log::error($e);
          }
    }
}
