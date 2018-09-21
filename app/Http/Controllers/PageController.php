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

    public function flights (Request $request) {
        $json = $request->input('data');
        $timezone = $request->input('timezone');
        $flightData = json_decode($json);

        $trip = new Trip();
        $allFlightsFound = true;

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

                $flight->departure_time = $this->getUtcTime($flight->departure_time, $timezone, $flight->departure_airport->timezone);

                $flight->timezone = $timezone;

                $trip->addFlight($flight);
            } else {
                $allFlightsFound = false;
                break;
            }
        }

        // Could not find all of the flights. Reset the trip's flights to avoid returning a partial trip
        if (!$allFlightsFound) {
            $trip->setFlights(array());
        }

        return view ('pages.flights')->with('trip', $trip);
    }

    public function getUtcTime ($time, $myTimezone, $timezone) {
        $datetime = new \DateTime($time, new \DateTimeZone($timezone));

        $datetime->setTimeZone(new \DateTimeZone($myTimezone));

        return $datetime->format('G:i');
    }

}