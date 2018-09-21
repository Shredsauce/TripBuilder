{{-- Departure --}}
<div class="row">
  <div class="form-group col-sm-8">
    <select class="form-control departureAirportSelect">
      <option value="none">Depart from</option>
      @foreach($airports as $airport)
      <option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
      @endforeach
    </select>
  </div>
</div>
{{-- Arrival --}}
<div class="row">
  <div class="form-group col-sm-8">
    <select class="form-control arrivalAirportSelect">
      <option value="none">Arrive at</option>
      @foreach($airports as $airport)
      <option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
      @endforeach
    </select>
  </div>
</div>