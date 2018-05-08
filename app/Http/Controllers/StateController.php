<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\State;

class StateController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index() {
      $states = State::all();
      return view('states', ['states' => $states]);
    }

    public function show(State $state) {
      $currentState = State::where('id', $state->id)->get();
      return view('state', ['state' => $currentState]);
    }
}
