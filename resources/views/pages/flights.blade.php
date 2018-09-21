<?php
use App\Http\Controllers\FlightController;
use App\TripClasses\Trip;
?>

@extends('layouts.app')

@section('content')
	<div class="jumbotron text-center">
		<h1>{{config('app.name', 'Trip Builder')}}</h1>
		<p>Build a trip</p>
		
		@if(count($trip->getFlights()) > 0)
			<div class="well">
				@foreach($trip->getFlights() as $flight)
					<div class="well">
						<div>
							Departure: {{$flight->departure_airport->city}} ({{$flight->departure_airport->code}})
							at {{$flight->departure_time}}
						</div>
						<div>
							Arrival: {{$flight->arrival_airport->city}} ({{$flight->arrival_airport->code}})
							at {{$flight->arrival_time}}
							on {{$flight->date}}
						</div>						
					</div>					

				@endforeach
				<div class="row">
					<label style="font-size: large;">${{$trip->getTotalPrice ()}}</label>
				</div>
			</div>
		@else
		Could not find any flights for your search criteria
		@endif

		{{-- page: {{$pagination['page']}} --}}


	</div>
@endsection
