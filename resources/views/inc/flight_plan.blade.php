<div id="flightplan" class="flightplan well">
  <div id="flight-number" class="row">
    <label class="flightNumberLabel">Flight 1</label>
  </div>
  {{-- Departure --}}
  <div class="row">
    <div class="form-group col-sm-6">
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
    <div class="form-group col-sm-6">
      <select class="form-control arrivalAirportSelect">
        <option value="any_arrival_airport">Any airport</option>
        @foreach($airports as $airport)
        <option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
        @endforeach
      </select>
    </div>
  </div>

  <div class="row">
    {{-- Leave calendar --}}
    <div id="leave-calendar" class="col-sm-3">
      <div class="form-group">
        <div class="input-group date" id="datetimepicker">
          <input type="text" class="form-control" />
          <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
      <script type="text/javascript">
        $(function () {
            $("#datetimepicker").datetimepicker();
        });
      </script>
    </div>
    {{-- Return calendar --}}
    <div id="return-calendar" class="col-sm-3">
      <div class="form-group">
        <div class="input-group date" id="datetimepicker">
          <input type="text" class="form-control" />
          <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
      <script type="text/javascript">
        $(function () {
            $("#datetimepicker").datetimepicker();
        });
      </script>
    </div>
  </div>
</div>