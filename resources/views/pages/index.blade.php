<?php use App\Http\Controllers\FlightController;?>

@extends('layouts.app')

@section('content')
	<div class="jumbotron text-center">
		<h1>{{config('app.name', 'Trip Builder')}}</h1>
		<p>Build a trip</p>

		<div id="flightplans">
			@include('inc.flight_plan', ['flight_number' => 1])
		</div>

		<button onclick="addFlight()" id="addFlightBtn" class="btn btn-default" role="button">Add flight</button>
		<button style="display: none;" onclick="removeFlight()" id="removeFlightBtn" class="btn btn-default" role="button">Remove flight</button>

		<button onclick="goToUrl()" id="searchBtn" class="btn btn-primary btn-lg" role="button">Search</button>

	</div>
@endsection

		<script type="text/javascript">
		function goToUrl () {
			var departure_airport = $('#departureAirportSelect1').val();
			var arrival_airport = $('#arrivalAirportSelect1').val();

			var url = "flights/"+departure_airport+"/"+arrival_airport;
			window.location.href = url;
		}

		function getAllFlightPlans () {
			return document.getElementsByClassName("flightplan");
		}

		function addFlight () {
			var flightPlans = getAllFlightPlans ();
			var newNumber = flightPlans.length+1;
	
			var clone = flightPlans[0].cloneNode(true);
			var flightplansContainer = document.getElementById("flightplans");
			flightplansContainer.appendChild(clone);

			// Change class names to reflect new flight number (very messy)
			clone.id = "flightplan"+newNumber;
			clone.getElementsByClassName("flightNumberLabel")[0].innerHTML = "Flight "+newNumber;
			clone.getElementsByClassName("departureAirportSelectLabel")[0].setAttribute("for", "departureAirportSelect"+newNumber);
			clone.getElementsByClassName("departureAirportSelectForm")[0].id = "departureAirportSelect"+newNumber;
			clone.getElementsByClassName("arrivalAirportSelectLabel")[0].setAttribute("for", "arrivalAirportSelect"+newNumber);
			clone.getElementsByClassName("arrivalAirportSelectForm")[0].id = "arrivalAirportSelect"+newNumber;

			
			document.getElementById("removeFlightBtn").style.display = "inline";

			if(getAllFlightPlans().length >= 5)
				document.getElementById("addFlightBtn").style.display = "none";			
		}

		function removeFlight () {
			var flightPlans = getAllFlightPlans ();
		        flightPlans[0].parentNode.removeChild(flightPlans[flightPlans.length-1]);

		    document.getElementById("addFlightBtn").style.display = "inline";

		    if(getAllFlightPlans().length <= 1)
		    	document.getElementById("removeFlightBtn").style.display = "none";
		}

		</script>