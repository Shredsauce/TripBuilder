<?php use App\Http\Controllers\FlightController;?>
@extends('layouts.app')
@section('content')
<div class="jumbotron text-center">
<h1>{{config('app.name', 'Trip Builder')}}</h1>
<p>Build a trip</p>

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
	@include('inc.flight_plan')
</div>

<button onclick="addFlight()" id="addFlightBtn" class="btn btn-default" role="button">Add flight</button>
<button style="display: none;" onclick="removeLastFlight()" id="removeFlightBtn" class="btn btn-default" role="button">Remove flight</button>
<div class="row">
	<button onclick="goToUrl()" id="searchBtn" class="btn btn-primary btn-lg" role="button">Search</button>
</div>

@endsection