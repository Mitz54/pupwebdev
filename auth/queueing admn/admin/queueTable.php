<?php
	session_start();
	include 'includes/databse.php';
	$dateToday = date("Y-m-d");
	$staffID = $_SESSION['accntID'];
	$num = $_POST['queueNewCount'];
	if($num == 1){
				$profNewCount = $_SESSION['PendingNum'];
	}
	else {
			$profNewCount = $_SESSION['PendingNum'];
	}
	//$sql2 = "UPDATE `queueingtransaction` INNER JOIN queue ON queue.queueNumber = queueingtransaction.queueID_FK SET `queueingTransactionStatus` = 'Done' WHERE `queue`.`queueNumber` = $profNewCount;";
	$result2 = mysqli_query($conn,"Call updateQueueTable('$profNewCount','$staffID')");
	include 'includes/databse.php';
	$result3 = mysqli_query($conn,"Call selectNext('$staffID')");
	include 'includes/databse.php';
	$resultCheck = mysqli_num_rows($result3);
			while ($row = mysqli_fetch_assoc($result3)) {
				$curServe = $row['queueNumber'];
					include 'includes/databse.php';
					$result = mysqli_query($conn,"Call updateNextToCurServe('$curServe','$staffID')");
				}

	

?>
