<?php
	require 'db.php';
	$roomInfos = array();
	$result = $mysqli->query("call selectAllRoom();") or die($mysqli->error());
	while($row = mysqli_fetch_array($result))
	{
		$roomInfo['roomID'] = $row["roomID"];
		$roomInfo['roomType'] = $row["roomType"];
		array_push($roomInfos,$roomInfo);
	}
	return $roomInfos;
?>
