<?php
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');


$scheduleDay = $_POST['scheduleDay'];		
$startTime = $_POST['startTime'];	
$endTime = $_POST['endTime'];	
$scheduleID = $_POST['scheduleID'];	
$reservationDate = null;		

$sql = "CALL updateSchedule('$scheduleDay', '$startTime','$endTime', '$scheduleID','$reservationDate')";

if ($con->query($sql) === TRUE) {

} else {
    echo "Error: " . $con->error;
}



// header('Location:http://localhost:1234/pupwebdev-iya/auth/admin/schedule.php?');
//    exit;

$con->close();


?>