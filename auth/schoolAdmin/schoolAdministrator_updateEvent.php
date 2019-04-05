<?php
  include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

$scheduleDay = $_POST['scheduleDay'];		
$startTime = $_POST['startTime'];	
$endTime = $_POST['endTime'];	
$scheduleID = $_POST['scheduleID'];		
$scheduleDate = $_POST['scheduleDate'];	

$sql = "CALL updateSchedule('$scheduleDay', '$startTime','$endTime', '$scheduleID','$scheduleDate')";

if ($con->query($sql) === TRUE) {
echo "nupdate dapat";
} else {
    echo "Error: " . $con->error;
}


// header('Location:http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_Reservation.php');
//    exit;

$con->close();


?>