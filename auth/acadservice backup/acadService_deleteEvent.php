<?php
 include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

$id = $_POST['id'];			

$sql = "CALL deleteSchedule('$id')";

if ($con->query($sql) === TRUE) {

} else {
    echo "Error: " . $con->error;
}

   
// header('Location:http://localhost:1234/pupwebdev-iya/auth/admin/schedule.php?');
//    exit;

$con->close();


?>