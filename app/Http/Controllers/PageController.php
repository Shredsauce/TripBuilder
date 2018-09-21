<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\TripClasses\Trip;

class PageController extends Controller {
    public function index () {
        $airports = DB::table('airports')->get();

        return view ('pages.index')->with('airports', $airports); 
    }

/*
    public function flights (
        $depart_A = null, $arriv_B = null, $depart_C = null, $arriv_D = null, $depart_E = null, $arriv_F = null, $depart_G = null, $arriv_H = null, $depart_I = null, $arriv_J = null,
        Request $request, $page = null) {
*/
    public function flights (Request $request) {
        $json = $request->input('data');
        $flightData = json_decode($json);

        $trip = new Trip();
        $allFlightsFound = TRUE;

        for ($i = 0; $i < count($flightData->flights); $i++) {
            $departure_airport = $flightData->flights[$i]->from;
            $arrival_airport = $flightData->flights[$i]->to;

            $flight = DB::table('flights')
                ->when($departure_airport, function ($query, $departure_airport) {
                    return $query->where('departure_airport', '=', $departure_airport);
                })
                ->when($arrival_airport, function ($query, $arrival_airport) {
                    return $query->where('arrival_airport', '=', $arrival_airport);
                })->first();        

            if ($flight != null) {
                // Fetch the full airport and airline data for each flight
                $flight->airline = DB::table('airports')->where('code', '=', $flight->airline)->first();
                $flight->departure_airport = DB::table('airports')->where('code', '=', $flight->departure_airport)->first();
                $flight->arrival_airport = DB::table('airports')->where('code', '=', $flight->arrival_airport)->first();

                $flight->date = $flightData->flights[$i]->date;

                $trip->addFlight($flight);
            } else {
                $allFlightsFound = FALSE;
                break;
            }
        }

        // Could not find all of the flights. Reset the trip's flights to avoid returning a partial trip
        if (!$allFlightsFound) {
            $trip->setFlights(array());
        }

        // return view ('pages.flights')->with('trip', $trip)->with('test', $test);
        return view ('pages.flights')->with('trip', $trip);
    }   
}