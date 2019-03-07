
<?php
//including the database connection file
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Room_Functions.php";


$oldRoomID = $_POST['oldRoomID'];
$newRoomID = $_POST['newRoomID'];
$roomType = $_POST['roomType'];

// validate here!

//update courseTitle
if($oldRoomID == $newRoomID ){
	echo "updated";

	updateRoom($con, $oldRoomID, $newRoomID , $roomType);
}else{
	// make sure newRoomID  does not exist
	$sql = 'SELECT roomID FROM room WHERE roomID = ?';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $newRoomID);
	$stmt->execute();
	$stmt->store_result();

	if($stmt->num_rows > 0){
        echo "exist";
	}else{
		echo "success";
		updateRoom($con, $oldRoomID, $newRoomID , $roomType);
	}
}
?>