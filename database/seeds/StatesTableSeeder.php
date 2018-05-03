<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    private $_states = [
      ["name" => "Alaska", "abbr" => "AK"],
      ["name" => "Alabama", "abbr" => "AL"],
      ["name" => "Arkansas", "abbr" => "AR"],
      ["name" => "Arizona", "abbr" => "AZ"],
      ["name" => "California", "abbr" => "CA"],
      ["name" => "Colorado", "abbr" => "CO"],
      ["name" => "Connecticut", "abbr" => "CT"],
      ["name" => "Delaware", "abbr" => "DE"],
      ["name" => "Florida", "abbr" => "FL"],
      ["name" => "Georgia", "abbr" => "GA"],
      ["name" => "Hawaii", "abbr" => "HI"],
      ["name" => "Iowa", "abbr" => "IA"],
      ["name" => "Idaho", "abbr" => "ID"],
      ["name" => "Illinois", "abbr" => "IL"],
      ["name" => "Indiana", "abbr" => "IN"],
      ["name" => "Kansas", "abbr" => "KS"],
      ["name" => "Kentucky", "abbr" => "KY"],
      ["name" => "Louisiana", "abbr" => "LA"],
      ["name" => "Massachusetts", "abbr" => "MA"],
      ["name" => "Maryland", "abbr" => "MD"],
      ["name" => "Maine", "abbr" => "ME"],
      ["name" => "Michigan", "abbr" => "MI"],
      ["name" => "Minnesota", "abbr" => "MN"],
      ["name" => "Missouri", "abbr" => "MO"],
      ["name" => "Mississippi", "abbr" => "MS"],
      ["name" => "Montana", "abbr" => "MT"],
      ["name" => "North Carolina", "abbr" => "NC"],
      ["name" => "North Dakota", "abbr" => "ND"],
      ["name" => "Nebraska", "abbr" => "NE"],
      ["name" => "New Hampshire", "abbr" => "NH"],
      ["name" => "New Jersey", "abbr" => "NJ"],
      ["name" => "New Mexico", "abbr" => "NM"],
      ["name" => "Nevada", "abbr" => "NV"],
      ["name" => "New York", "abbr" => "NY"],
      ["name" => "Ohio", "abbr" => "OH"],
      ["name" => "Oklahoma", "abbr" => "OK"],
      ["name" => "Oregon", "abbr" => "OR"],
      ["name" => "Pennsylvania", "abbr" => "PA"],
      ["name" => "Rhode Island", "abbr" => "RI"],
      ["name" => "South Carolina", "abbr" => "SC"],
      ["name" => "South Dakota", "abbr" => "SD"],
      ["name" => "Tennessee", "abbr" => "TN"],
      ["name" => "Texas", "abbr" => "TX"],
      ["name" => "Utah", "abbr" => "UT"],
      ["name" => "Virginia", "abbr" => "VA"],
      ["name" => "Vermont", "abbr" => "VT"],
      ["name" => "Washington", "abbr" => "WA"],
      ["name" => "Wisconsin", "abbr" => "WI"],
      ["name" => "West Virginia", "abbr" => "WV"],
      ["name" => "Wyoming", "abbr" => "WY"]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach ( $this->_states as $state ) {
        \App\Models\State::firstOrCreate(['name' => $state->name, 'abbr' => $state->abbr]);
      }
    }
}
