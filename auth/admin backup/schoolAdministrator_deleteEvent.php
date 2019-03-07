<?php
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

$id = $_POST['id'];			

$sql = "CALL deleteSchedule('$id')";

if ($con->query($sql) === TRUE) {
echo "nadelete dapat";
} else {
    echo "Error: " . $con->error;
}


//header('Location:http://localhost:1234/pupwebdev/auth/admin/schoolAdministrator_Reservation.php?');
  // exit;

$con->close();


?>