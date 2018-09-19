<?php use App\Http\Controllers\FlightController;?>

@extends('layouts.app')

@section('content')
	<div class="jumbotron text-center">
		<h1>{{config('app.name', 'Trip Builder')}}</h1>
		<p>Build a trip</p>

		<a href="{{ url('/services/') }}" class="btn btn-xs btn-info pull-right">Sort</a>

{{-- 		@if(count($data['flights']) > 0)
			<ul class="list-group">
				@foreach($data['flights'] as $flight)
					<li class="list-group-item">
						<div class="column">
						{{$flight->airline}}

						</div>
<div class="column">
						{{$flight->number}}

						</div>						
					</li>
				@endforeach
			</ul>
		@endif
 --}}	

		{{-- Calendar --}}
		<div class="row">
		    <div class='col-sm-6'>
		        <div class="form-group">
		            <div class='input-group date' id='datetimepicker1'>
		                <input type='text' class="form-control" />
		                <span class="input-group-addon">
		                    <span class="glyphicon glyphicon-calendar"></span>
		                </span>
		            </div>
		        </div>
		    </div>
		    <script type="text/javascript">
		        $(function () {
		            $('#datetimepicker1').datetimepicker();
		        });
		    </script>
		</div>


		<div class="row">

			<div class="dropdown show">
			  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Departure locations
			  </a>

			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			    <a class="dropdown-item" href="#">Departure location</a>
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