<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Station;

class StationController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
      $stations = Station::all();
      return view('stations', ['stations' => $stations]);
    }

    public function show(Station $station) {
      $currentStation = Station::where('id', $station->id)->get();
      return view('station', ['station' => $currentStation]);
    }
}
