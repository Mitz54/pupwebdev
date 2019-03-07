<?php
 include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

$del = $_POST['del'];


$sql = "CALL deleteRoomSchedule('$del')";




if($del=="All")
{

	 $query = $con->query("CALL deleteAllRoomSchedule()"); 
}


if ($con->query($sql) === TRUE) {

} else {
    echo "Error: " . $con->error;
}

   
// header('Location:http://localhost:1234/pupwebdev-iya/auth/admin/schedule.php?');
//    exit;

$con->close();


?>