<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name', 'Trip Builder')}}</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />

        <!-- Load icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <script src="{{ asset('js/app.js') }}"></script>

        <!-- For calendar -->
        <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
        <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    </head>
    <body>
    	@include('inc.navbar')
    	<div class="container">
	        @yield('content')
	    </div>

        <script type="text/javascript"> 
            $(document).ready(function() {

                $('#return-datepicker').datetimepicker({
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                    minDate: moment().add(1, 'days')
                });     

                $('#datepicker1').datetimepicker({
                    format: 'DD/MM/YYYY',
                    minDate: moment()
                });

                $("#datepicker1").on("dp.change", function (e) {
                    $('#return-datepicker').data("DateTimePicker").minDate(e.date.add(1, 'days'));
                    $('#return-datepicker').data("DateTimePicker").maxDate(e.date.add(365, 'days'));          
                });
                if($('#datepicker2').length) {
                    $("#datepicker2").on("dp.change", function (e) {
                        $('#datepicker1').data("DateTimePicker").maxDate(e.date);
                    });
                }

                setRoundtrip ();
            
                $("#rountetrip-tab").click(function() {
                    setRoundtrip ();
                });
                $("#oneway-tab").click(function() {
                    setOneway ();
                });
                $("#multicity-tab").click(function() {
                    setMulticity ();
                });
            });
            
            function setRoundtrip () {
                initFlightPlan ();
                tripType = "roundtrip";
                
                document.getElementById("return-calendar").style.display = "block";
            }
            
            function setOneway () {
                initFlightPlan ();
                tripType = "oneway";
            }
            
            function setMulticity () {
                initFlightPlan ();
                tripType = "multicity";
            
                document.getElementById("addFlightBtn").style.display = "inline";
                document.getElementById("removeFlightBtn").style.display = "inline";
                document.getElementById("flight-number").style.display = "inline";
                addFlight ();
            }
            
            function initFlightPlan () {
                var flightPlans = document.getElementsByClassName("flightplan");
                if (flightPlans.length >= 2) {
                    for (i = 0; i < flightPlans.length; i++) {
                        removeLastFlight ();
                    }
                }

                document.getElementById("return-calendar").style.display = "none";
                document.getElementById("addFlightBtn").style.display = "none";
                document.getElementById("removeFlightBtn").style.display = "none";
                document.getElementById("flight-number").style.display = "none";
            }

            function goToUrl () {
                var url = "flights/";
                var departures = document.getElementsByClassName("departureAirportSelect");
                var arrivals = document.getElementsByClassName("arrivalAirportSelect"); 

                var flights = [];

                switch(tripType) {
                    case "roundtrip":
                        var leaveDate = document.getElementById('datepickerinput1').value;
                        var returnDate = document.getElementById('return-datepickerinput').value;

                        flights.push({from: departures[0].value, to: arrivals[0].value, date: leaveDate});
                        flights.push({from: arrivals[0].value, to: departures[0].value, date: returnDate});

                        break;
                    case "oneway":
                        var date = document.getElementById('datepickerinput1').value;
                        flights.push({from: departures[0].value, to: arrivals[0].value, date: date});
                
                        break;
                    case "multicity":
                        for(i = 0; i < departures.length; i++) {
                            var date = document.getElementById('datepickerinput'+(i+1)).value;
                            flights.push({from: departures[i].value, to: arrivals[i].value, date: date});
                        }
                        break;                  
                    default:
                }

                var filledFields = true;

                for(i = 0; i < flights.length; i++) {
                    if (flights[i]['from'] == "none" || flights[i]['to'] == "none" || !flights[i]['date']) {
                        alert("Please fill in all the fields");
                        filledFields = false;
                        break;
                    }
                }

                if (filledFields) {
                    var json = {flights: flights};

                    url += "?data="+encodeURI(JSON.stringify(json))+"&timezone=EST";

                    window.location.href = url;
                }
            }

            function addFlight () {
                var flightPlans = document.getElementsByClassName("flightplan");
                var newNumber = flightPlans.length+1;

                var clone = flightPlans[0].cloneNode(true);
                var flightplansContainer = document.getElementById("flightplans");
                flightplansContainer.appendChild(clone);

                clone.getElementsByClassName("flightNumberLabel")[0].innerHTML = "Flight "+newNumber;

                document.getElementById("removeFlightBtn").style.display = "inline";

                clone.getElementsByClassName("date")[0].setAttribute("id", "datepicker"+newNumber);
                clone.getElementsByClassName("dateinput")[0].setAttribute("id", "datepickerinput"+newNumber);



                $('#datepicker'+newNumber).datetimepicker({
                    format: 'DD/MM/YYYY',
                    useCurrent: false,
                    minDate: moment().add(1, 'days')
                });     

                if(flightPlans.length >= 5)
                    document.getElementById("addFlightBtn").style.display = "none";     
            }
            
            function removeLastFlight () {
                var flightPlans = document.getElementById("flightplans").getElementsByClassName("flightplan");
                flightPlans[0].parentNode.removeChild(flightPlans[flightPlans.length-1]);
            
                document.getElementById("addFlightBtn").style.display = "inline";
            
                if(flightPlans.length <= 1)
                    document.getElementById("removeFlightBtn").style.display = "none";
            }
            
        </script>

    </body>
</html>
