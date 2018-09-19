<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller {
    public function index () {
        $flights = DB::table('flights')->get();

        // Fetch the full airport and airline data for each flight
        foreach ($flights as $flight) {
            $flight->airline = DB::table('airports')->where('code', '=', $flight->airline)->first();
            $flight->departure_airport = DB::table('airports')->where('code', '=', $flight->departure_airport)->first();
            $flight->arrival_airport = DB::table('airports')->where('code', '=', $flight->arrival_airport)->first();
        }
        
        return view ('pages.index')->with('flights', $flights); 
    }

    // Get flight information from sqlite database
    public function flights() {
        $flights = DB::table('flights')->get();
        $airlines = DB::table('airlines')->get();
        $airports = DB::table('airports')->get();

        $data = array('flights' => $flights);

        $data = array(
            'flights'  => $flights,
            'airlines' => $airlines,
            'airports' => $airports
        );

        return view ('pages.flights')->with('data', $data); 
    }

   // Get flight information from sqlite database
    public function flights2() {
        $flights2 = "this is flights 2";
        return view ('pages.flights')->with('flights2', $flights2); 
    }    
}