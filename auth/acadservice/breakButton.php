<?php
	session_start();
	include ($_SERVER['DOCUMENT_ROOT'].'/pupwebdev/auth/dbConnect.php');
	$dateToday = date("Y-m-d");
	$staffID = $_SESSION['accntID'];
	$profNewCount = $_SESSION['PendingNum'];
	//$sql2 = "UPDATE `queueingtransaction` INNER JOIN queue ON queue.queueNumber = queueingtransaction.queueID_FK SET `queueingTransactionStatus` = 'Done' WHERE `queue`.`queueNumber` = $profNewCount;";
    $result2 = mysqli_query($con,"Call updateQueueTable('$profNewCount','$staffID')");
    
    ?>