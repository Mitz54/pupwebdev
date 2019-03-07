
<?php
include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
include "Room_Functions.php";

$roomID = $_POST['roomID'];
deleteRoom($con, $roomID);

?>