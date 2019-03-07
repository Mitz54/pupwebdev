<?php
	session_start();
	include_once ($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
	//$num = $_POST['queueNewCount'];	
	
	$dateToday = date("Y-m-d");
	$comm = $_POST['pendRemark'];
	$staffID = $_SESSION['accntID'];

		$profNewCount = $_SESSION['PendingNum'];


	//$sql2 = "UPDATE `queueingtransaction` SET `queueingTransactionStatus` = 'Pending' WHERE `queueingtransaction`.`queueingTransactionID` = $profNewCount;";
	//$result2 = mysqli_query($conn,"call UpdatePending('$profNewCount','$dateToday','$staffID')");
	//$sql = "UPDATE `queueingtransaction` SET `Remarks` = '$remarks' WHERE `queueingtransaction`.`queueingTransactionID` = $profNewCount;";
	$result = mysqli_query($con,"call updatePendTable('$comm','$profNewCount','$dateToday','$staffID')");
	$_SESSION['PendingNum'] = 0;
	header('location: queuePerOffice.php');
?>
