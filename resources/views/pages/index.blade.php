<?php use App\Http\Controllers\FlightController;?>

@extends('layouts.app')

@section('content')
	<div class="jumbotron text-center">
		<h1>{{config('app.name', 'Trip Builder')}}</h1>
		<p>Build a trip</p>

		@php
		$departure_airport = "any_departure_airport";
        $arrival_airport = "any_arrival_airport";
		@endphp

		<div class="form-group">
		<label for="departureAirportSelect">Departure airport</label>
		<select class="form-control" id="departureAirportSelect">
			<option>YUL</option>
			<option>YVR</option>
		</select>
		</div>

		<div class="form-group">
		<label for="arrivalAirportSelect">Arrival airport</label>
		<select class="form-control" id="arrivalAirportSelect">
			<option>YUL</option>
			<option>YVR</option>
		</select>
		</div>		

		{{-- Calendar --}}
		<div class="row">
		    <div class='col-sm-6'>
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

		<script type="text/javascript">
		function goToUrl () {
			var departure_airport = $('#departureAirportSelect').val();
			var arrival_airport = $('#arrivalAirportSelect').val();
			var url = "flights/"+departure_airport+"/"+arrival_airport;
			window.location.href = url;
		}
		</script>

		<button onclick="goToUrl()" id="searchBtn" class="btn btn-primary" role="button">Search</button>

		<div class="row">

			<div class="dropdown show">
			  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Departure locations
			  </a>

			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			    <a class="dropdown-item" href="#">YUL</a>
			    <a class="dropdown-item" href="#">Departure location</a>
			    <a class="dropdown-item" href="#">Departure location</a>
			  </div>
			</div>


			<div class="dropdown show">
			  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Departure dates
			  </a>

			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			    <a class="dropdown-item" href="#">Departure date</a>
			    <a class="dropdown-item" href="#">Departure date</a>
			    <a class="dropdown-item" href="#">Departure date</a>
			  </div>
			</div>


			<div class="dropdown show">
			  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Arrival locations
			  </a>

			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			    <a class="dropdown-item" href="#">Arrival location</a>
			    <a class="dropdown-item" href="#">Arrival location</a>
			    <a class="dropdown-item" href="#">Arrival location</a>
			  </div>
			</div>


		</div> <!-- End row -->


	</div>
@endsection