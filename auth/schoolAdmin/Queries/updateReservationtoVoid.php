<?php
include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');

$sql = "CALL updateReservationtoVoid()";

$con->query($sql);
$con->close();


?>