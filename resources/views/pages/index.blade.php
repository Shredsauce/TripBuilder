<?php use App\Http\Controllers\FlightController;?>
@extends('layouts.app')
@section('content')
<div class="jumbotron text-center">
<h1>{{config('app.name', 'Trip Builder')}}</h1>
<p>Build a trip</p>
<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
	<li class="nav-item">
		<a class="nav-link active" id="rountetrip-tab" data-toggle="tab" href="#rountetriptab" role="tab" aria-controls="home" aria-selected="true">Round Trip</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="oneway-tab" data-toggle="tab" href="#onewaytab" role="tab" aria-controls="profile" aria-selected="false">One Way</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" id="multicity-tab" data-toggle="tab" href="#multicitytab" role="tab" aria-controls="messages" aria-selected="false">Multi-City</a>
	</li>
</ul>

<div id="flightplans">
	<div id="flightplan" class="flightplan well">
		<div id="flight-number" class="row">
			<label class="flightNumberLabel">Flight 1</label>
		</div>
		{{-- Departure --}}
		<div class="row">
			<div class="form-group col-sm-6">
				{{-- <label class="departureAirportSelectLabel" for="departureAirportSelect">Departure airport</label> --}}
				<select class="form-control departureAirportSelect">
					<option value="any_departure_airport">Any airport</option>
					@foreach($airports as $airport)
					<option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
					@endforeach
				</select>
			</div>
		</div>
		{{-- Arrival --}}
		<div class="row">
			<div class="form-group col-sm-6">
				{{-- <label class="arrivalAirportSelectLabel" for="departure">Arrival airport</label> --}}
				<select class="form-control arrivalAirportSelect">
					<option value="any_arrival_airport">Any airport</option>
					@foreach($airports as $airport)
					<option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
					@endforeach
				</select>
			</div>
		</div>

		<div class="row">
			{{-- Leave calendar --}}
			<div id="leave-calendar" class="col-sm-3">
				<div class="form-group">
					<div class="input-group date" id="datetimepicker">
						<input type="text" class="form-control" />
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
				<script type="text/javascript">
					$(function () {
					    $("#datetimepicker").datetimepicker();
					});
				</script>
			</div>
			{{-- Return calendar --}}
			<div id="return-calendar" class="col-sm-3">
				<div class="form-group">
					<div class="input-group date" id="datetimepicker">
						<input type="text" class="form-control" />
						<span class="input-group-addon">
						<span class="glyphicon glyphicon-calendar"></span>
						</span>
					</div>
				</div>
				<script type="text/javascript">
					$(function () {
					    $("#datetimepicker").datetimepicker();
					});
				</script>
			</div>
		</div>
	</div>
</div>

<button onclick="addFlight()" id="addFlightBtn" class="btn btn-default" role="button">Add flight</button>
<button style="display: none;" onclick="removeLastFlight()" id="removeFlightBtn" class="btn btn-default" role="button">Remove flight</button>
<div class="row">
	<button onclick="goToUrl()" id="searchBtn" class="btn btn-primary btn-lg" role="button">Search</button>
</div>

	{{-- <!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="rountetriptab" role="tabpanel" aria-labelledby="rountetrip-tab">
		</div>
		<div class="tab-pane" id="onewaytab" role="tabpanel" aria-labelledby="oneway-tab">
			<div id="flightplans">
			</div>
		</div>
		<div class="tab-pane" id="multicitytab" role="tabpanel" aria-labelledby="multicity-tab">
			<div id="flightplanmulticity">
			</div>
			<div class="row">
			</div>
		</div>
	</div>
	--}}
	<script type="text/javascript">		
		$(document).ready(function() {
			setRoundtrip ();
		
		    $("#rountetrip-tab").click(function() {
				setRoundtrip ();
		    });
		    $("#oneway-tab").click(function() {
				setOneway ();
		    });
		    $("#multicity-tab").click(function() {
				setMulticity ();
		    });
		});
		
		function setRoundtrip () {
			initFlightPlan ();
			tripType = "roundtrip";
		
			document.getElementById("return-calendar").style.display = "block";
		}
		
		function setOneway () {
		   	initFlightPlan ();
		   	tripType = "oneway";
		}
		
		function setMulticity () {
			initFlightPlan ();
			tripType = "multicity";
		
			document.getElementById("addFlightBtn").style.display = "inline";
			document.getElementById("removeFlightBtn").style.display = "inline";
			document.getElementById("flight-number").style.display = "inline";
			addFlight ();
		}
		
		function initFlightPlan () {
			document.getElementById("return-calendar").style.display = "none";
			document.getElementById("addFlightBtn").style.display = "none";
			document.getElementById("removeFlightBtn").style.display = "none";
			document.getElementById("flight-number").style.display = "none";
		
			var flightPlans = document.getElementsByClassName("flightplan");
			if (flightPlans.length >= 2) {
				for (i = 0; i < flightPlans.length; i++) {
					removeLastFlight ();
				}
			}
		}

		function goToUrl () {
			var url = "flights/";
			var departures = document.getElementsByClassName("departureAirportSelect");
			var arrivals = document.getElementsByClassName("arrivalAirportSelect");	

			switch(tripType) {
				case "roundtrip":
					url += departures[0].value+"/";
					url += arrivals[0].value+"/";
					url += arrivals[0].value+"/";
					url += departures[0].value;					
					break;
				case "oneway":
					url += departures[0].value+"/";
					url += arrivals[0].value;					
					break;
				case "multicity":
					for(i = 0; i < departures.length; i++) {
						url += departures[i].value+"/";
						url += arrivals[i].value+"/";
					}
					break;					
				default:
			}

			window.location.href = url;
		}
		
		function addFlight () {
			var flightPlans = document.getElementsByClassName("flightplan");
			var newNumber = flightPlans.length+1;

			var clone = flightPlans[0].cloneNode(true);
			var flightplansContainer = document.getElementById("flightplans");
			flightplansContainer.appendChild(clone);

			clone.getElementsByClassName("flightNumberLabel")[0].innerHTML = "Flight "+newNumber;

			document.getElementById("removeFlightBtn").style.display = "inline";

			if(flightPlans.length >= 5)
				document.getElementById("addFlightBtn").style.display = "none";     
		}
		
		function removeLastFlight () {
			var flightPlans = document.getElementById("flightplans").getElementsByClassName("flightplan");
			flightPlans[0].parentNode.removeChild(flightPlans[flightPlans.length-1]);
		
			document.getElementById("addFlightBtn").style.display = "inline";
		
			if(flightPlans.length <= 1)
				document.getElementById("removeFlightBtn").style.display = "none";
		}
		
	</script>
@endsection