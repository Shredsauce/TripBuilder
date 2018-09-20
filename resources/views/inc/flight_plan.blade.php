<div id="flightplan{{ $flight_number }}" class="flightplan well">
  <div class="row">
    <label class="flightNumberLabel">Flight {{ $flight_number }}</label>
  </div>

  {{-- Departure --}}
  <div class="row">
    <div class="form-group">
    <label class="departureAirportSelectLabel" for="departureAirportSelect{{ $flight_number }}">Departure airport</label>
    <select class="form-control departureAirportSelectForm" id="departureAirportSelect{{ $flight_number }}">
      <option value="any_departure_airport">Any airport</option>
      @foreach($airports as $airport)
        <option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
      @endforeach
    </select>
    </div>
  </div>

  {{-- Arrival --}}
  <div class="row">
    <div class="form-group">
    <label class="arrivalAirportSelectLabel" for="arrivalAirportSelect{{ $flight_number }}">Arrival airport</label>
    <select class="form-control arrivalAirportSelectForm" id="arrivalAirportSelect{{ $flight_number }}">
      <option value="any_arrival_airport">Any airport</option>
      @foreach($airports as $airport)
        <option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
      @endforeach
    </select>
    </div>
  </div> 

  {{-- Calendar --}}
  <div class="row">
      <div class='col-sm-3'>
          <div class="form-group">
              <div class='input-group date' id='datetimepicker{{ $flight_number }}'>
                  <input type='text' class="form-control" />
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
      </div>
      <script type="text/javascript">
          $(function () {
              $('#datetimepicker{{ $flight_number }}').datetimepicker();
          });
      </script>
  </div>
</div>
