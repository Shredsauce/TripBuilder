@extends('layouts.app')

@section('content')
	<h1>{{config('app.name', 'Trip Builder')}}</h1>

	@if(count($flights) > 0)
		<ul class="list-group">
			@foreach($flights as $flight)
				<li class="list-group-item">{{$flight->airline}}</li>
			@endforeach
		</ul>
	@endif
@endsection