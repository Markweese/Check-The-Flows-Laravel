<?php

use Illuminate\Database\Seeder;

class InitiativesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Models\Initiative::class, 4000)->create();
    }
}
