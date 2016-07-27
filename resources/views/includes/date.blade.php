{{--<html>--}}
{{--<script type="text/javascript" src="http://www.datejs.com/build/date.js"></script>--}}

{{--<script>--}}
	{{--(function ()--}}
	{{--{--}}
		{{--document.write(new Date().toString("hh:mm tt"));--}}
	{{--})();--}}
{{--</script>--}}
{{--</html>--}}


<div id="timer"></div>

<script>
	setInterval(function() {
		var currentTime = new Date ( );
		var currentHours = currentTime.getHours ( );
		var currentMinutes = currentTime.getMinutes ( );
		var currentSeconds = currentTime.getSeconds ( );
		currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
		currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
		var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
		currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
		currentHours = ( currentHours == 0 ) ? 12 : currentHours;
		var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
		document.getElementById("timer").innerHTML = currentTimeString;
	}, 1000);
</script>