<?php
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

$reservationID = $_POST['reservationID'];		

$sql = "CALL updateReservationLetter('$reservationID')";

$con->query($sql);
$con->close();


?>