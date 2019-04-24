
<?php
//including the database connection file
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Room_Functions.php";

$roomID = trim($_POST['roomID']);
$roomType = trim($_POST['roomType']);
// validate here!

$cleanID = clean($roomID);
$replace_query = replace_query("roomID");
// make sure newCourseID  does not exist
$sql = 'SELECT roomID FROM room WHERE '.$replace_query.' = ?';
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $cleanID);
$stmt->execute();
$stmt->store_result();

if($stmt->num_rows > 0){
    echo "exist";
}else{
	echo "success";
	insertRoom($con, $roomID , $roomType);
}
?>