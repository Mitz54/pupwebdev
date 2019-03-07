<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
	$roomInfos = array();
	$result = $con->query("call selectAllRoom();") or die(mysqli_error($con));
	while($row = mysqli_fetch_array($result))
	{
		$roomInfo['roomID'] = $row["roomID"];
		$roomInfo['roomType'] = $row["roomType"];
		array_push($roomInfos,$roomInfo);
	}
	mysqli_next_result($con);
	return $roomInfos;
?>
