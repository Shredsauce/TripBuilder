<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller {

    public function index () {
        $airports = DB::table('airports')->get();

        return view ('pages.index')->with('airports', $airports); 
    }

    public function flights ($departure_airport = null, $arrival_airport = null, $page = null) {
        if ($departure_airport == "any_departure_airport") {
            $departure_airport = null;
        }
        if ($arrival_airport == "any_arrival_airport") {
            $arrival_airport = null;
        }

        $flights = DB::table('flights')
            ->when($departure_airport, function ($query, $departure_airport) {
                return $query->where('departure_airport', '=', $departure_airport);
            })
            ->when($arrival_airport, function ($query, $arrival_airport) {
                return $query->where('arrival_airport', '=', $arrival_airport);
            })            
           ->paginate(10);

        // Fetch the full airport and airline data for each flight
        foreach ($flights as $flight) {
            $flight->airline = DB::table('airports')->where('code', '=', $flight->airline)->first();
            $flight->departure_airport = DB::table('airports')->where('code', '=', $flight->departure_airport)->first();
            $flight->arrival_airport = DB::table('airports')->where('code', '=', $flight->arrival_airport)->first();
        }
        $pagination = array(
            'page'  => $page
        );


        return view ('pages.flights')->with('flights', $flights)->with('pagination', $pagination); 
    }

    // // Get flight information from sqlite database
    // public function flights() {
    //     $flights = DB::table('flights')->get();
    //     $airlines = DB::table('airlines')->get();
    //     $airports = DB::table('airports')->get();

    //     $data = array('flights' => $flights);

    //     $data = array(
    //         'flights'  => $flights,
    //         'airlines' => $airlines,
    //         'airports' => $airports
    //     );

    //     return view ('pages.flights')->with('data', $data); 
    // }

    // // Get flight information from sqlite database
    // public function flights() {
    //     $flights = DB::table('flights')->get();
    //     $airlines = DB::table('airlines')->get();
    //     $airports = DB::table('airports')->get();

    //     $data = array('flights' => $flights);

    //     $data = array(
    //         'flights'  => $flights,
    //         'airlines' => $airlines,
    //         'airports' => $airports
    //     );

    //     return view ('pages.flights')->with('data', $data); 
    // }

   // // Get flight information from sqlite database
   //  public function flights2() {
   //      $flights2 = "this is flights 2";
   //      return view ('pages.flights')->with('flights2', $flights2); 
   //  }    
}