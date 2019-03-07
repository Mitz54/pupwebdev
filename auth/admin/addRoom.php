
<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Room_Functions.php";

$roomID = $_POST['roomID'];
$roomType = $_POST['roomType'];
// validate here!

// make sure newCourseID  does not exist
$sql = 'SELECT roomID FROM room WHERE roomID = ?';
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $roomID);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo "exist";
}else{
	echo "success";
	insertRoom($con, $roomID , $roomType);
}
?>