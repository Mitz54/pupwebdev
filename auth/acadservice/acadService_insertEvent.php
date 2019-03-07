

<?php
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

	$section = $_POST['section'];
	$subject = $_POST['subject'];
	$startTime = $_POST['startTime'];
	$endTime = $_POST['endTime'];
	$selDay = $_POST['selDay'];
	$room = $_POST['room'];
	$professor = $_POST['professor'];



	$sql = "CALL insertRoomSchedule('$section','$subject','$startTime','$endTime','$selDay','$room','$professor')";

	if ($con->query($sql) === TRUE) 
	{
	
	 
	} else {
	    echo "Error: " . $con->error;
	}



//	header('Location:http://localhost:1234/pupwebdev-iya/auth/admin/schedule.php?');
//	   exit;

	$con->close();


?>


