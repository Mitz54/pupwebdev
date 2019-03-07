<?php
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
$name = $_POST['name'];				//Juan DC
$purpose = $_POST['purpose'];		//Seminar
$date = $_POST['date'];				//YYYY-MM-DD
$section = $_POST['section'];		//IT 1-1
$start = $_POST['startTime'];		
$end = $_POST['endTime'];
$room = $_POST['room'];				//R3-1
$day = $_POST['day'];				//mon




$sql = "CALL insertReservationSchedule('$name','$purpose','$date','$section','$start','$end','$room','$day');";

if ($con->query($sql) === TRUE) {

  //  echo 'tama';
} else {
    echo "Error: " . $con->error;
}

//header('Location:http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_Reservation.php?');
  // exit;

$con->close();


?>