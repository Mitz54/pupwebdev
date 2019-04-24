
<?php
//including the database connection file
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Room_Functions.php";


$oldRoomID = trim($_POST['oldRoomID']);
$newRoomID = trim($_POST['newRoomID']);
$roomType = trim($_POST['roomType']);

// validate here!

//update courseTitle
if($oldRoomID == $newRoomID ){
	echo "updated";

	updateRoom($con, $oldRoomID, $newRoomID , $roomType);
}else{

	$newCleanID = clean($newRoomID);
	$oldCleanID = clean($oldRoomID);
	$replace_query = replace_query("roomID");
	// make sure newRoomID  does not exist
	$sql = 'SELECT roomID FROM room WHERE '.$replace_query.' = ? AND '.$replace_query.' NOT LIKE "'.$oldCleanID.'"';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("s", $newCleanID);
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