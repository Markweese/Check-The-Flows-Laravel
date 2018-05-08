<?php

use Illuminate\Database\Seeder;

class stationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Models\Station::class, 1000)->create();
    }
}
