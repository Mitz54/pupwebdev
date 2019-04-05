<?php
  include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

$scheduleDay = $_POST['scheduleDay'];		
$startTime = $_POST['startTime'];	
$endTime = $_POST['endTime'];	
$scheduleID = $_POST['scheduleID'];		
$scheduledate = $_POST['scheduledate'];

$sql = "CALL updateSchedule('$scheduleDay', '$startTime','$endTime', '$scheduleID','$scheduledate')";

if ($con->query($sql) === TRUE) {
echo "updated";
} else {
    echo "Error: " . $con->error;
}


// header('Location:http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_Reservation.php?');
//    exit;

$con->close();


?>