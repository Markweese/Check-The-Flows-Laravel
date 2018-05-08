<?php

use Illuminate\Database\Seeder;

class ReadingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(App\Models\Reading::class, 5000)->create();
    }
}
