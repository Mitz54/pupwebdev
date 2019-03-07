<?php
	include_once($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
	$officeInfos = array();
	$result = $con->query("call SelectAllOffice();") or die(mysqli_error($con));
	while($row = mysqli_fetch_array($result))
	{
		$officeInfo['officeID'] = $row['officeID'];
		$officeInfo['officeName'] = $row['officeName'];
		$officeInfo['staffID'] = $row['staffID_FK'];
		$officeInfo['roomID'] = $row['roomID_FK'];
		array_push($officeInfos,$officeInfo);
	}
	mysqli_next_result($con);
	return $officeInfos;
?>
