<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Flight;

class TripController extends Controller {
    
    public function index () {
        return view('pages.index');
    }


    // // public function getFlights($departure_location) {
    // public function getFlights() {
    //     $flights = DB::table('flights')->where('departure_airport', '=', 'YUL')->get();

    //     return $flights;
    // }

    // public function getAirlines() {
    //     $airlines = DB::table('airlines')->get();
    //     return $airlines;
    // }

    // public function getAirports() {
    //     $airports = DB::table('airports')->get();
    //     return $airports;
    // }
}