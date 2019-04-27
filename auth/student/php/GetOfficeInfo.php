<?php
	include($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
	$officeInfos = array();
	$countoffice =0;
	$result = $con->query("call SelectAllOffice();") or die($con->error());
	while($row = mysqli_fetch_array($result))
	{
		$officeInfo['officeID'] = $row['officeID'];
		$officeInfo['officeName'] = $row['officeName'];
		$officeInfo['staffID'] = $row['staffID_FK'];
		$officeInfo['roomID'] = $row['roomID_FK'];
		$countoffice++;
		array_push($officeInfos,$officeInfo);
	}
	return $officeInfos;
?>
