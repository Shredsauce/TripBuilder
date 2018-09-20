<?php use App\Http\Controllers\FlightController;?>

@extends('layouts.app')

@section('content')
	<div class="jumbotron text-center">
		<h1>{{config('app.name', 'Trip Builder')}}</h1>
		<p>Build a trip</p>

		@include('inc.flight_plan', ['flight_number' => 1])
		@include('inc.flight_plan', ['flight_number' => 2])

		<script type="text/javascript">
		function goToUrl () {
			var departure_airport = $('#departureAirportSelect1').val();
			var arrival_airport = $('#arrivalAirportSelect1').val();
			
			var url = "flights/"+departure_airport+"/"+arrival_airport;
			window.location.href = url;
		}
		</script>

		<button onclick="goToUrl()" id="searchBtn" class="btn btn-primary btn-lg" role="button">Search</button>
	</div>
@endsection