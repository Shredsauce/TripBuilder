<?php use App\Http\Controllers\FlightController;?>

@extends('layouts.app')

@section('content')
	<div class="jumbotron text-center">
		<h1>{{config('app.name', 'Trip Builder')}}</h1>
		<p>Build a trip</p>

		<a href="{{ url('/services/') }}" class="btn btn-xs btn-info pull-right">Sort</a>

		@if(count($flights) > 0)
			<ul class="list-group">
				@foreach($flights as $flight)
					<li class="list-group-item">
						<div class="row">
							${{$flight->price}}
						</div>						
						<div class="row">
							Only one seat left!
						</div>	
	
						<ol>
							Departure: {{$flight->departure_airport->city}} ({{$flight->departure_airport->code}})
							at {{$flight->departure_time}}
						</ol>
						<ol>
							Arrival: {{$flight->arrival_airport->city}} ({{$flight->arrival_airport->code}})
							at {{$flight->arrival_time}}
						</ol>						
					</li>
				@endforeach
			</ul>
		@else
		Could not find any flights for your search criteria
		@endif

		{{-- page: {{$pagination->page}} --}}


	</div>
@endsection
