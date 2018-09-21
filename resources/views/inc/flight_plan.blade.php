<div id="flightplan" class="flightplan well">
  <div id="flight-number" class="row">
    <label class="flightNumberLabel">Flight 1</label>
  </div>
  {{-- Departure --}}
  <div class="row">
    <div class="form-group col-sm-8">
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
    <div class="form-group col-sm-8">
      <select class="form-control arrivalAirportSelect">
        <option value="any_arrival_airport">Any airport</option>
        @foreach($airports as $airport)
        <option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="row">
    <div class='col-md-4'>
      <div class="form-group">
        <div class='input-group date' id='datepicker1'>
          <input type='text' class="form-control dateinput" id='datepickerinput1' />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>
    <div id="return-calendar" class='col-md-4'>
      <div class="form-group">
        <div class='input-group date datepicker' id='return-datepicker'>
          <input type='text' class="form-control dateinput" id='return-datepickerinput' />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>
  </div>

</div>