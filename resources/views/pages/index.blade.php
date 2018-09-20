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
	    <div class="form-group form-inline">
	    <label class="departureAirportSelectLabel" for="departureAirportSelect">Departure airport</label>
	    <select class="form-control departureAirportSelectForm" id="departureAirportSelect">
	      <option value="any_departure_airport">Any airport</option>
	      @foreach($airports as $airport)
	        <option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
	      @endforeach
	    </select>
	    </div>
	  </div>

	  {{-- Arrival --}}
	  <div class="row">
	    <div class="form-group form-inline">
	    <label class="arrivalAirportSelectLabel" for="arrivalAirportSelect">Arrival airport</label>
	    <select class="form-control arrivalAirportSelectForm" id="arrivalAirportSelect">
	      <option value="any_arrival_airport">Any airport</option>
	      @foreach($airports as $airport)
	        <option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
	      @endforeach
	    </select>
	    </div>
	  </div> 

	  {{-- Leave calendar --}}
	  <div id="leave-calendar" class="row">
	      <div class='col-sm-3'>
	          <div class="form-group">
	              <div class='input-group date' id='datetimepicker'>
	                  <input type='text' class="form-control" />
	                  <span class="input-group-addon">
	                      <span class="glyphicon glyphicon-calendar"></span>
	                  </span>
	              </div>
	          </div>
	      </div>
	      <script type="text/javascript">
	          $(function () {
	              $('#datetimepicker').datetimepicker();
	          });
	      </script>
	  </div>

	  {{-- Return calendar --}}
	  <div id="return-calendar" class="row">
	      <div class='col-sm-3'>
	          <div class="form-group">
	              <div class='input-group date' id='datetimepicker'>
	                  <input type='text' class="form-control" />
	                  <span class="input-group-addon">
	                      <span class="glyphicon glyphicon-calendar"></span>
	                  </span>
	              </div>
	          </div>
	      </div>
	      <script type="text/javascript">
	          $(function () {
	              $('#datetimepicker').datetimepicker();
	          });
	      </script>
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
	var tripType = "rountetrip";

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
		tripType = "rountetrip";

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
	  var departure_airport = $('#departureAirportSelect').val();
	  var arrival_airport = $('#arrivalAirportSelect').val();
	  var url = "flights/"+departure_airport+"/"+arrival_airport;
	  window.location.href = url;
	}

	function addFlight () {
	  var flightPlans = document.getElementsByClassName("flightplan");
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

{{-- 
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
		<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="rountetriptab" role="tabpanel" aria-labelledby="rountetrip-tab">
	@include('inc.flight_plan', ['flight_number' => 1, 'flight_type' => 'roundtrip'])
  </div>
  <div class="tab-pane" id="onewaytab" role="tabpanel" aria-labelledby="oneway-tab">
  	<div id="flightplans">
		@include('inc.flight_plan', ['flight_number' => 1, 'flight_type' => 'oneway'])
	</div>

	<div class="row">
	  <button onclick="goToUrl()" id="searchBtn" class="btn btn-primary btn-lg" role="button">Search</button>
	</div>  
  </div>
  <div class="tab-pane" id="multicitytab" role="tabpanel" aria-labelledby="multicity-tab">
	<div id="flightplanmulticity">
		@include('inc.flight_plan', ['flight_number' => 1, 'flight_type' => 'multicity'])
	</div>

	<button onclick="addFlight()" id="addFlightBtn" class="btn btn-default" role="button">Add flight</button>
	<button style="display: none;" onclick="removeFlight()" id="removeFlightBtn" class="btn btn-default" role="button">Remove flight</button>
  	
  	<div class="row">
	  <button onclick="goToUrl()" id="searchBtn" class="btn btn-primary btn-lg" role="button">Search</button>
	</div>  

  </div>
</div>
 --}}

	</div>
@endsection
			
