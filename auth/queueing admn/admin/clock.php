<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JS Clock</title>
	<style type="text/css">
		.clock{
			position: absolute;
			top: 3%;
			left: 91%;
			transform translateX(-50%) translateY(-50%);
			font-size: 25px;
			border: 1px solid #000;
			padding: 0px 5px 0px 5px;
		}
	</style>
</head>
<body>
	<div id=ClockDisplay class="clock"></div>
	<script type="text/javascript">
		
		function showTime(){
			var date = new Date();
			var h = date.getHours(); 
			var m = date.getMinutes(); 
			var s = date.getSeconds();
			var d = date.getDay();
			var session = "AM";

			if (h == 0){
				h = 12;
			}

			if (h > 12){
				h = h -12;
				session = "PM";
			}

			h = (h < 10) ? "0" + h : h;
			m = (m < 10) ? "0" + m : m;
			s = (s < 10) ? "0" + s : s;

			var time = h + ":" + m + ":" + s + " " + session;

			document.getElementById("ClockDisplay").innerText = time;
			document.getElementById("ClockDisplay").textContent = time;

			setTimeout(showTime, 1000);
		}

	showTime();
	</script>

	<?php
		echo "Today is ".date("Y-m-d")."<br>";
		echo "Today is ".date("l");

	  ?>
</body>
</html>