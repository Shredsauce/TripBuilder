<div id="flightplan{{$flight_number}}{{$flight_type}}" class="flightplan well">
  <div class="row">
    <label class="flightNumberLabel">Flight {{$flight_number}}</label>
  </div>

  {{-- Departure --}}
  <div class="row">
    <div class="form-group form-inline">
    <label class="departureAirportSelectLabel" for="departureAirportSelect{{$flight_number}}{{$flight_type}}">Departure airport</label>
    <select class="form-control departureAirportSelectForm" id="departureAirportSelect{{$flight_number}}{{$flight_type}}">
      <option value="any_departure_airport">Any airport</option>
      @foreach($airports as $airport)
        <option value="{{$airport->code}}">{{$airport->name}} ({{$airport->code}})</option>
      @endforeach
    </select>
    </div>
  </div>

  {{-- Arrival --}}
  <div class="row">
    <div class="form-group form-inline">
    <label class="arrivalAirportSelectLabel" for="arrivalAirportSelect{{$flight_number}}">Arrival airport</label>
    <select class="form-control arrivalAirportSelectForm" id="arrivalAirportSelect{{$flight_number}}{{$flight_type}}">
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
              <div class='input-group date' id='datetimepicker{{$flight_number}}{{$flight_type}}'>
                  <input type='text' class="form-control" />
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
      </div>
      <script type="text/javascript">
          $(function () {
              $('#datetimepicker{{$flight_number}}{{$flight_type}}').datetimepicker();
          });
      </script>
  </div>
</div>

<div class="row">
  <button onclick="goToUrl()" id="searchBtn" class="btn btn-primary btn-lg" role="button">Search</button>
</div> 

<script type="text/javascript">

function goToUrl () {
  var departure_airport = $('#departureAirportSelect1{{$flight_type}}').val();
  var arrival_airport = $('#arrivalAirportSelect1').val();

  var url = "flights/"+departure_airport+"/"+arrival_airport;
  // window.location.href = url;
  alert("{{$flight_type}}");
}

function getAllFlightPlans () {
  return document.getElementsByClassName("flightplan");
}

function addFlight () {
  var flightPlans = getAllFlightPlans ();
  var newNumber = flightPlans.length+1;

  var clone = flightPlans[0].cloneNode(true);
  var flightplansContainer = document.getElementById("flightplan{{$flight_number}}{{$flight_type}}");
  flightplansContainer.appendChild(clone);

  // Change class names to reflect new flight number (very messy)
  clone.id = "flightplan"+newNumber;
  clone.getElementsByClassName("flightNumberLabel")[0].innerHTML = "Flight "+newNumber+{{$flight_type}};
  clone.getElementsByClassName("departureAirportSelectLabel")[0].setAttribute("for", "departureAirportSelect"+newNumber+{{$flight_type}});
  clone.getElementsByClassName("departureAirportSelectForm")[0].id = "departureAirportSelect"+newNumber+{{$flight_type}};
  clone.getElementsByClassName("arrivalAirportSelectLabel")[0].setAttribute("for", "arrivalAirportSelect"+newNumber+{{$flight_type}});
  clone.getElementsByClassName("arrivalAirportSelectForm")[0].id = "arrivalAirportSelect"+newNumber+{{$flight_type}};

  document.getElementById("removeFlightBtn").style.display = "inline";

  if(getAllFlightPlans().length >= 5)
    document.getElementById("addFlightBtn").style.display = "none";     
}

function removeFlight () {
  var flightPlans = document.getElementById("multicitytab").getElementsByClassName("flightplan");
    flightPlans[0].parentNode.removeChild(flightPlans[flightPlans.length-1]);

    document.getElementById("addFlightBtn").style.display = "inline";

    if(flightPlans.length <= 1)
      document.getElementById("removeFlightBtn").style.display = "none";
}

</script>