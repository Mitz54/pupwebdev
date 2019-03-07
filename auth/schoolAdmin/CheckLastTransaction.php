<?php
    include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
    $staffID = $_SESSION['accntID'];

    $lastqueue = "";
    $result = $con->query("call selectLastQueuePerOffice($staffID);") or die($con->error());
	while($row = mysqli_fetch_array($result))
	{
		$lastqueue = $row['lastqueue'];
	}
	return $lastqueue;
?>