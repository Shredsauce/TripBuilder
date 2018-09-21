<?php

namespace App\TripClasses;

class Trip {
    private $flights = array();

    public function addFlight ($flights) {
        $this->flights[] = $flights;
    }

    public function getFlights() {
        return $this->flights;
    }

    public function setFlights($flights) {
        $this->flights = $flights;
    }

    public function getTotalPrice () {
        $totalPrice = 0;
        for ($i = 0; $i < count($this->flights); $i++) {
            $totalPrice += $this->flights[$i]->price;
        }
        return number_format($totalPrice,2);
    }

    public static function getUtcTime ($time, $timezone) {
        return $time;
    }
}